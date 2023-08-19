function validateForm(formSelector,pdfSelector,submitButtonSelector){
    formElement = document.querySelector(formSelector);
    pdfElement = document.querySelector(pdfSelector);
    submitButtonElement = document.querySelector(submitButtonSelector);
  
    submitButtonElement.addEventListener("click",(event)=>{
      let pdfFileName = pdfElement.files[0];
  
      if(pdfFileName){
      }
      else{
        genearateError("add a pdf file",pdfElement);
      }
    });
  }
  validateForm("main > form",".PdfThumbnail #PdfUploadInput",".PdfThumbnail button");