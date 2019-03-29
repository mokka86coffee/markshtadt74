document.addEventListener("DOMContentLoaded", function(){
    

    //    Заголовк хэдера появление
    

    //    Заголовк хэдера появление

   



    var string = "Чтобы избавиться от нежелательных слеш-символов, например вставленных с помощью уже устаревшей директивы magic_quotes_gpc, применяется следующий код: $variable = stripslashes($variable); А для удаления из строки любого HTML-кода используется такой код PHP: $variable = htmlentities($variable); Например, этот код интерпретируемого HTML <b>hi</b> заменяется стро- кой &lt;b&gt;hi&lt;/b&gt;, которая отображается как простой текст и не будет mokka@gmail.com ин- терпретироваться как теги HTML. И наконец, если нужно полностью очистить введенные данные от HTML, ис- пользуется следующий код 9820873020 (но использовать его нужно до вызова функции htmlentities, которая заменяет все угловые скобки, используемые в качестве со- ставляющих HTML-тегов):  $variable = strip_tags($variable); А пока вы не решите, какое именно обезвреживание требуется для вашей програм- мы, рассмотрите показанные в примере 11.9 две функции, в которых собраны вместе все эти ограничения, обеспечивающие довольно высокий уровень безопасности.";
        var pattern = /\b(\d){3}(\d|-|\.|\s){8,10}/gmi;  // russian phone pattern

        var pattern_tel_clear = /\s|-|\./gi;  // phone clear pattern

    var btn1 = document.getElementsByClassName('tick');
    btn1 = btn1[0];
    
    var inp = document.getElementById('inp');

    btn1.addEventListener('click', function (){
        
        string = inp.value;

        
        if ( string.match(pattern) ) {

    	       var newString = string.match(pattern);

               newString = newString[0];

               console.log( newString );
        
               newString = newString.replace(pattern_tel_clear,'');
        
               newString = '+7 ' + newString;
       
               console.log( newString );
               
               console.log(screen);

        }
          // else inp.style.border.color = 'red';

    });
    
    

        

});  // End of DOMContentLoaded