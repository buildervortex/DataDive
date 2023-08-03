function setTheProfile(profilePictureSeletor,profilePictureinputSelector){
    
    const profilePicture = document.querySelector(profilePictureSeletor);
    const profilePictureInput = document.querySelector(profilePictureinputSelector);
  
    profilePicture.addEventListener('click', function() {
      profilePictureInput.click();
      console.log("hello");
    });
  
    profilePictureInput.addEventListener('change', function(event) {
      const selectedFile = event.target.files[0];
      const reader = new FileReader();
  
      reader.onload = function() {
        profilePicture.src = reader.result;
      };
  
      if (selectedFile) {
        reader.readAsDataURL(selectedFile);
      }
    });

}

setTheProfile("main .PdfThumbnail #PdfUploadImg","main .PdfThumbnail #PdfUploadInput");
setTheProfile("main .PdfThumbnail #ThumbnailUploadImg","main .PdfThumbnail #ThumbnailUploadInput");

function genearateError(message,adjacentElement){
  let errorMessage = document.createElement("h4");
  errorMessage.style = "background-color:red;padding: 1cqb 4cqb;border-radius:20px";
  errorMessage.innerText = message;
  adjacentElement.insertAdjacentElement("afterend",errorMessage);

  setTimeout(()=>{
    adjacentElement.parentElement.removeChild(errorMessage);
  },1000);
}

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