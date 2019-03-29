//http://rnbtheme.com/forty_three/menu-page/
//http://nativewptheme.net/ninteenth/
import './index.scss';



function showInfo(modal,e) {
    e.stopPropagation();
    modal.classList.add('modal--ready'); 
}
 
function showMenu(modal, e) {
    let path = e.path[0].dataset.menu ? e.path[0].dataset.menu : e.path[1].dataset.menu;
    console.log(path);
    e.stopPropagation();
    e.preventDefault();
    modal.classList.add('modal--ready');
}

function showPhotos(modal, e) {
    e.stopPropagation();
    e.preventDefault();
    modal.classList.add('modal--ready'); 
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
// Getting index of slide

let toggleSlide = function (slides, name, { target: { classList: { value } } }) {
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

let $=( tag, _$={
    node: document.querySelectorAll(tag),
    method: (event,func)=> 
        (_$.node
            .forEach(n=>
                n.addEventListener(event, func, true) ), 
            _$
        )
    }) => _$;

window.onload = () => {
    (async function (){ for (let node of document.getElementsByTagName('img')) { 
        await new Promise(res=>{ 
            node.src=node.dataset.src; 
            node.dataset.src=''; 
            node.onerror=(err)=>{
                console.log(err); 
                res();
            }
            node.onload = ()=>res(); 
        }) 
    } })();
    //  Imgs one by one loading

    $('.modal').method('click', (e) => e.target.classList.remove('modal--ready'));
    $('.modal__close').method('click', (e) => e.target.parentNode.parentNode.classList.remove('modal--ready'));
    // modal hide on click
    
    $('.services__item--about').method('click', showInfo.bind({}, $('.modal--info').node[0]));
    // show/hide restaurant info

    $('.dishes__item, .footer-nav__column--menu').method('click', showMenu.bind({}, $('.modal--menu').node[0]));
    // show/hide restaurant menu



    
    $('.services__item--gallery, [data-href="gallery"]').method('click', showPhotos.bind({}, $('.modal--photos-halls').node[0]));
    // show/hide restaurant halls photos

    $('.modal--photos-halls .modal-photos__arrow').method('click', toggleSlide.bind({index: 0}, $('.modal--photos-halls .modal-photos__slider .modal-photos__img').node, 'halls'));
    // toggle restaurant halls photos


    
    $('[data-href="news"]').method('click', showPhotos.bind({}, $('.modal--photos-news').node[0]));
    // show/hide restaurant news photos

    $('.modal--photos-news .modal-photos__arrow').method('click', toggleSlide.bind({index: 0}, $('.modal--photos-news .modal-photos__slider img').node, 'news'));
    // toggle slides restaurant news photos
};
