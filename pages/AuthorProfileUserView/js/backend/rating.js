function rate(event,Author,User){
    let rateValue = event.target.value;
    let phpFileName = "/pages/AuthorProfileUserView/php/rate.php";
    

    let jsonObject = {
        "rate":rateValue,
        "AutherId":Author,
        "UserId":User,
    }
    fetch(phpFileName,{
        method:"POST",
        headers: {
            'Content-Type': "application/json",
        },
        body: JSON.stringify(jsonObject)
    });
}