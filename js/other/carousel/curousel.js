export class Curousel{
    timeInterval=1000;
    speed=10;
    carouselContainerElement;
    leftArrowElement;
    rightArrowElement;
    intervalObject;

    constructor(carouselContainerSelector=".carosalContainer",timeInterval=100,speed=10,leftArrowKeySelector=".carosal #leftArrow",rightArrowKeySelector=".carosal #rightArrow"){
        this.speed = speed;
        this.timeInterval=timeInterval;
        
        this.carouselContainerElement= document.querySelector(carouselContainerSelector);
        this.leftArrowElement = document.querySelector(leftArrowKeySelector);
        this.rightArrowElement = document.querySelector(rightArrowKeySelector);

        if (!this.carouselContainerElement){
            console.log("The Cursouel selecting was failed");
        }
        if (!this.leftArrowElement && !this.rightArrowElement){
            console.log("The carousel arrows selecting was failed");
        }

        // arrow keys registration
        this.arrowKeyRegister();
        this.hoverStop();
        this.run();
    }
    hoverStop(){
        this.carouselContainerElement.addEventListener("mouseover",()=>{
            this.stop();
        });
        this.carouselContainerElement.addEventListener("mouseleave",()=>{
            this.run();
        });
        this.leftArrowElement.addEventListener("mouseover",()=>{
            this.stop();
        });
        this.leftArrowElement.addEventListener("mouseleave",()=>{
            this.run();
        });

        this.rightArrowElement.addEventListener("mouseover",()=>{
            this.stop();
        });
        this.rightArrowElement.addEventListener("mouseleave",()=>{
            this.run();
        });
        
    }
    moveCarousel=(count=0)=>{

        if(count!=0){
            this.carouselContainerElement.scrollLeft += count;
            return;
        }
        this.carouselContainerElement.scrollLeft+=this.speed;
        if(this.carouselContainerElement.scrollLeft>= this.carouselContainerElement.scrollLeftMax){
            let firstNode = this.carouselContainerElement.firstElementChild;
            this.carouselContainerElement.removeChild(firstNode);
            this.carouselContainerElement.scrollLeft = this.carouselContainerElement.scrollLeftMax;
            this.carouselContainerElement.appendChild(firstNode.cloneNode(true));
        }
    }

    run(){
        this.intervalObject = setInterval(this.moveCarousel,this.timeInterval);
    }
    stop(){
        clearInterval(this.intervalObject);
    }

    arrowKeyRegister(){
        this.leftArrowElement.addEventListener("click",()=>{
            this.moveCarousel(-(this.carouselContainerElement.firstElementChild.offsetWidth*2.5));
        });
        this.rightArrowElement.addEventListener("click",()=>{
            this.moveCarousel(this.carouselContainerElement.firstElementChild.offsetWidth*2.5);
        });
    }
}



// const ob = new Curousel();
