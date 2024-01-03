var FNextBtn = document.querySelector('.flash__sale__next__btn')
var FPrevBtn = document.querySelector('.flash__sale__prev__btn')
var FPrdoductList = document.querySelector('.flash__sale__product__list')
var FPrdoductIem = document.querySelectorAll('.flash__sale__product')
var Fl = 238
var Findex = 0
var FPositionX = 0
FNextBtn.addEventListener('click',function(){
    FHandle(1)
})
FPrevBtn.addEventListener('click',function(){
    FHandle(-1)
})
function FHandle (Fnumber){
    var itemsPerPage = 5;
    var totalProducts = FPrdoductIem.length;
    var maxIndex = totalProducts - itemsPerPage;
    if( Fnumber == 1){
        if (Findex >= maxIndex) return;
        console.log('Next')
        FPositionX = FPositionX - Fl
        FPrdoductList.style = `transform: translateX(${FPositionX}px)`
        Findex++
        console.log('Findex' , Findex)
    }
    if( Fnumber == -1){
        if( Findex <= 0)return
        console.log('Prev')
        FPositionX = FPositionX + Fl
        FPrdoductList.style = `transform: translateX(${FPositionX}px)`
        Findex--
        console.log('Findex' , Findex)
    }
}