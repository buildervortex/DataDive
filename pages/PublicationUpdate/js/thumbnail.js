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

setTheProfile("main .PdfThumbnail img","main .PdfThumbnail input");