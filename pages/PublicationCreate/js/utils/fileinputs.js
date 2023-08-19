import {setImgFormInput,LinkElements} from "/shared/js/utils/thumbnailHandler.js";

export function setTheThumbnail(thumbnailViewElementSelector = "main .PdfThumbnail #ThumbnailUploadImg",thumbnailInputElementSelector="main .PdfThumbnail #ThumbnailUploadInput"){
    
    const thumbnailViewElement = document.querySelector(thumbnailViewElementSelector);
    const thumbnailInputElement = document.querySelector(thumbnailInputElementSelector);

    LinkElements(thumbnailViewElement,thumbnailInputElement);
  
    thumbnailInputElement.addEventListener('change', function(event) {
      setImgFormInput(thumbnailViewElement,thumbnailInputElement);
    });

}

export function pdfFileUploadHandler(pdfImageElementSelector="main .PdfThumbnail #PdfUploadImg",pdfFileInputTagSelector="main .PdfThumbnail #PdfUploadInput",indicatorElementSelector="main header.PdfThumbnail h4"){
    const pdfFileInputElement = document.querySelector(pdfFileInputTagSelector);
    const indicatorElement = document.querySelector(indicatorElementSelector);
    const pdfImageElement = document.querySelector(pdfImageElementSelector);

    LinkElements(pdfImageElement,pdfFileInputElement);

    pdfFileInputElement.addEventListener("change",(event)=>{
        let title = event.target.files[0].name;
        indicatorElement.innerText = title;
    });
}
