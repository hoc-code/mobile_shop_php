var NextBtn = document.querySelector('.slider__top__next__btn')
var PrevtBtn = document.querySelector('.slider__top__prev__btn')
var SlideWrapper = document.querySelector('.slider__top__wrapper')
var l = 684.98
var index = 0
var positionX = 0
// Automatic Slider
var randomNumber
setInterval(function(){
    randomNumber = Math.floor(Math.random()*5)
    switch(randomNumber){
        case 0:
            index = 0
            break
        case 1:
            index = 1      
            positionX = -l
            SlideWrapper.style = `transform: translateX(${positionX}px);`
            break  
        case 2:
            index = 2      
            positionX = -l*2
            SlideWrapper.style = `transform: translateX(${positionX}px);` 
            break  
        case 3:
            index = 3      
            positionX = -l*3
            SlideWrapper.style = `transform: translateX(${positionX}px);` 
            break   
        case 4: 
            index = 4      
            positionX = -l*4
            SlideWrapper.style = `transform: translateX(${positionX}px);` 
            break 
        case 5:
            index = 5      
            positionX = -l*4
            SlideWrapper.style = `transform: translateX(${positionX}px);` 
            break                                       
    }
    },5000)
    NextBtn.addEventListener('click' ,function(){
        Handle(1)
    })
    PrevtBtn.addEventListener('click' ,function(){
        Handle(-1)
    })
    function Handle ($number){
        if( $number == 1) {
            if( index >= 5)return
            positionX = positionX - l
            SlideWrapper.style = `transform: translateX(${positionX}px);`  
            ++index
            console.log('index', index)
        }
        else if( $number == -1) {
            if(index <= 0)return
            positionX = positionX + l
            SlideWrapper.style = `transform: translateX(${positionX}px);`
            --index
        }
    } 