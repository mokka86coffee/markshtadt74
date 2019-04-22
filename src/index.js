import './index.scss';

//? processing
function crossBrowserFetch (url, optionObj = { on: 'GET', body: undefined }, JSONparsing = true) {
    return new Promise((resolve, reject) => {
        const req = new XMLHttpRequest();
        req.open(optionObj.on, url);

        if (optionObj.headers) {
            for (let key in optionObj.headers) {
                req.setRequestHeader(key, optionObj.headers[key]);
            }
        }

        req.onload = () => {
            if (req.status === 200) {
                if (JSONparsing) {
                    resolve(JSON.parse(req.response));
                } else {
                    resolve(req.response);
                }
            } else {
                reject(Error(req.statusText));
            }
        };

        req.send(optionObj.body);
    })
}


function showInfo(modal,e) {
    e.stopPropagation();
    e.preventDefault();
    modal.classList.add('modal--ready'); 
}

function createNode(tag, attr, parentNode) {
    let node = document.createElement(tag);
    if ('className' in attr ) { node.className = attr['className'] }
    if ('src' in attr ) { node.setAttribute('src', attr['src']) }
    if ('text' in attr ) { node.innerHTML = attr['text'] }
    parentNode.append(node);
    return node;
}

function mapMenuObjectToSpans (obj, menuDivNode) {
    for ( let key in obj ) {
        let parentPNode = createNode('p', {}, menuDivNode);
        createNode('span', { className: 'content__item content__item--first', text: key }, parentPNode);
        createNode('span', { className: 'content__item content__item--dotted' }, parentPNode);
        createNode('span', { className: 'content__item content__item--last', text: `${obj[key]} ${rublSVG}` }, parentPNode);
    }
}

async function showMenu(modal, e) {
    e.stopPropagation();
    e.preventDefault();
    let path = e.path[0].dataset.menu ? e.path[0].dataset.menu : e.path[1].dataset.menu;
    
    let menuDivNode = document.querySelector('.modal-menu__content');
    modal.classList.add('modal--ready');
    menuDivNode.innerHTML = '';
    try {

        let menuObj = JSON.parse( localStorage.getItem('menusObj') )[path];
        console.log(path)
        console.log(menuObj)
    
        // ? localStorage.getItem('menusObj')[path] : await ajaxGetData(`bluda_id=${path}`); // main | banket | child
        
    
        for (let key in menuObj) {
            if (key === 'title') { document.querySelector('.modal-menu__info-title').innerText = menuObj['title']; continue; }
            if (key === 'img') { document.querySelector('.modal-menu__img').setAttribute('src',menuObj['img']); continue; }
            if (key === 'description') { document.querySelector('.modal-menu__info-text').innerText = menuObj['description']; continue; }
            createNode('h4', {text: key}, menuDivNode);
            mapMenuObjectToSpans(menuObj[key], menuDivNode);
        }
    } catch (err) {
        document.querySelector('h1').innerText = err.toString()
    }

}

function showPhotos(modal, e) {
    e.stopPropagation();
    e.preventDefault();
    modal.classList.add('modal--ready');
}

function renderPhotos(e, parentDiv) {
    $('.modal-photos__tabs li').node.forEach(el=>el.className = '');
    if (e) { e.target.className = 'active' }
    else { $('.modal-photos__tabs li').node[0].className = 'active' }

    let title = e ? e.target.dataset.text : $('.modal-photos__tabs li').node[0].dataset.text;
    parentDiv.innerHTML = '';
    this.index = 0;

    this.slides[title].forEach( (el,i) => {
        let div = createNode('div', { className: `modal-photos__img ${i===0 ? 'modal-photos__img--active' : ''}` }, parentDiv );
        createNode('img', { src: el.url}, div);
    });

    this.nodes = $('.modal--photos-halls .modal-photos__img').node;

    const hallsPhObj = this;
    const hallsPhTouchFn = handleTouch.bind(hallsPhObj);
    
    const hallsPhToggleFn = toggleSlide.bind(hallsPhObj, this.nodes, 'halls');
    hallsPhObj.PhToggleFn = hallsPhToggleFn;


    $('.modal--photos-halls .modal-photos__arrow').node.forEach(n=>n.onclick = hallsPhToggleFn);
    $('.modal--photos-halls').on(['touchstart','touchmove','touchend'], hallsPhTouchFn);
}

function chngIndex(right, quanity, index) {
return right
    ? index +1 < quanity
        ? index +1  
        : 0
    : index -1 < 0
        ? quanity-1
        : index -1;
}

function toggleSlide (slides, name, { target: { classList: { value } } }) {
    
    let 
        slideToRight = ~value.indexOf('right'),
        slidesQuanity = slides.length,
        currentIndex = this.index
    ; 

    if ( name === 'halls' ) {
        currentIndex = chngIndex(slideToRight, slidesQuanity, currentIndex);
        let prevSlide = chngIndex(slideToRight ? !slideToRight : slideToRight, slidesQuanity, currentIndex),
            nextSlide = chngIndex(slideToRight ? slideToRight : !slideToRight, slidesQuanity, currentIndex);
        
        slides[currentIndex].className = `modal-photos__img modal-photos__img--active`;
        slides[prevSlide].className = `modal-photos__img modal-photos__img--prev`;
        slides[nextSlide].className = `modal-photos__img modal-photos__img--next`;
    } else {
        slides[currentIndex].className = `modal-photos__img`;
        currentIndex = chngIndex(slideToRight, slidesQuanity, currentIndex);
        slides[currentIndex].className = `modal-photos__img modal-photos__img--active`;
    }

    this.index = currentIndex;
}

function handleTouch (e){

    if ( this.posX === 'moving') return;

    const { type, touches: [current] } = e;
    
    if ( type === 'touchend' ) {
        this.posX = null;
        return;
    }

    this.posX = type === 'touchstart' ? current.pageX : this.posX;
    
    if ( this.posX > current.pageX ) {
        this.PhToggleFn({ target: { classList: { value: 'left' } } });
        this.posX = 'moving';
        setTimeout( (obj) => obj.posX = 0, 500, this );
    }
    else if ( this.posX < current.pageX ) {
        this.PhToggleFn({ target: { classList: { value: 'right' } } });
        this.posX = 'moving';
        setTimeout( (obj) => obj.posX = 0, 500, this );
    } else return;
    
}

let $=( tag, _$={})=>{
    _$ = {
        node: document.querySelectorAll(tag),
        on: (event,func)=> !Array.isArray(event)
                ? Array.from(_$.node).forEach(n=>n.addEventListener(event, func, true) )
                : event.forEach( ev => Array.from(_$.node).forEach(n=>n.addEventListener(ev, func, true) ) )  
            
    }
    return _$;
}

window.onload = async () => {
    $('.preloader').node[0].classList.add('hidden');
{
    await (async () => { 
        for (let node of document.getElementsByTagName('img')) { 
            try {
                await new Promise( (res,rej) =>{ 
                    if (!node.dataset.src) { res(); }
                    else {
                        node.src=node.dataset.src; 
                        node.dataset.src=''; 
                        node.onerror = ()=> {rej()}
                        node.onload = ()=>res(); 
                    }
                })
            } catch (err) {
            }
        }
    })();
    //  Imgs one by one loading

    $('.modal').on('click', (e) => e.target.classList.remove('modal--ready'));
    $('.modal__close').on('click', (e) => e.target.parentNode.parentNode.classList.remove('modal--ready'));
    // modal hide on click

    $('.services__item--about').on('click', showInfo.bind({}, $('.modal--info').node[0]));
    // show/hide restaurant info

    $('[data-href="contacts"]').on('click', showInfo.bind({}, $('.modal--contacts').node[0]));
    // show/hide restaurant contacts

    $('.dishes__item, .footer-nav__column--menu').on('click', showMenu.bind({}, $('.modal--menu').node[0]));
    // show/hide restaurant menu



    $('.services__item--gallery, [data-href="gallery"]').on('click', showPhotos.bind({}, $('.modal--photos-halls').node[0]));
    // show/hide restaurant halls photos
    
    $('[data-text]').on('click', e=>renderPhotos(e,hallsDiv) );
    // toggle restaurant halls photos

}

{
    $('[data-href="news"]').on('click', showPhotos.bind({}, $('.modal--photos-news').node[0]));
    // show/hide restaurant news photos

    const newsPhObj = { index: 0 };
    const newsPhTouchFn = handleTouch.bind(newsPhObj);
    
    const newsPhToggleFn = toggleSlide.bind(newsPhObj, $('.modal--photos-news .modal-photos__slider img').node, 'news');
    newsPhObj.PhToggleFn = newsPhToggleFn;

    $('.modal--photos-news .modal-photos__arrow').on('click', newsPhToggleFn);
    $('.modal--photos-news').on(['touchstart','touchmove','touchend'], newsPhTouchFn);
    // toggle slides restaurant news photos
} // restaurant news photos
    


{  
    $('[data-href="offers"]').on('click', showPhotos.bind({}, $('.modal--photos-offers').node[0]));
    // show/hide restaurant offers photos

    const offersPhObj = { index: 0 };
    const offersPhTouchFn = handleTouch.bind(offersPhObj);
    
    const offersPhToggleFn = toggleSlide.bind(offersPhObj, $('.modal--photos-offers .modal-photos__slider img').node, 'offers');
    offersPhObj.PhToggleFn = offersPhToggleFn;
    

    $('.modal--photos-offers .modal-photos__arrow').on('click', offersPhToggleFn);
    $('.modal--photos-offers').on(['touchstart','touchmove','touchend'], offersPhTouchFn);
    // toggle slides restaurant offers photos

} // restaurant offers photos

    const hallsObj = { index: 0, slides: await crossBrowserFetch(`functions.php?halls=${true}`), nodes: $('.modal--photos-halls .modal-photos__img').node };
    const hallsDiv = $('.modal-photos__slide').node[0]; 
    
    renderPhotos = renderPhotos.bind(hallsObj);
    renderPhotos(null, hallsDiv);
    
    await (async function (){ 
        for (let node of document.getElementsByTagName('iframe')) { 
            node.src = node.dataset.src;
        } 
    })();

    const promiseArr = [
        crossBrowserFetch(`functions.php?bluda_id=main`),
        crossBrowserFetch(`functions.php?bluda_id=banket`),
        crossBrowserFetch(`functions.php?bluda_id=child`),
    ];
    if ( !localStorage.getItem('menusObj') ) {
        Promise.all(promiseArr)
        .then( r => {
            console.log(r);
            localStorage.setItem('menusObj', JSON.stringify({ main: r[1], banket: r[0], child: r[2] })) 
        })
    }
};

var rublSVG = `<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 330 330" style="width: 10px;" xml:space="preserve"> <path id="XMLID_449_" d="M180,170c46.869,0,85-38.131,85-85S226.869,0,180,0c-0.183,0-0.365,0.003-0.546,0.01h-69.434 c-0.007,0-0.013-0.001-0.019-0.001c-8.284,0-15,6.716-15,15v0.001V155v45H80c-8.284,0-15,6.716-15,15s6.716,15,15,15h15v85 c0,8.284,6.716,15,15,15s15-6.716,15-15v-85h55c8.284,0,15-6.716,15-15s-6.716-15-15-15h-55v-30H180z M180,30.01 c0.162,0,0.324-0.003,0.484-0.008C210.59,30.262,235,54.834,235,85c0,30.327-24.673,55-55,55h-55V30.01H180z"/> </svg>`;


