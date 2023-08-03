function likeHandler(event){
    event.preventDefault();
    userId = event.target.getAttribute("userId");
    publicationId = event.target.getAttribute("publicationId");

    likeThePublication("./php/like.php",userId,publicationId,event.target);
}

function goback(){
    window.history.back();
}


function likeThePublication(phpFileName,UserId,PublicationId,element){
    let jsonObject = {
        "UserId": UserId,
        "PublicationId": PublicationId,
    };

    fetch(phpFileName, {
        method: 'POST',
        headers: {
            'Content-Type': "application/json",
        },
        body: JSON.stringify(jsonObject)

    }).then(response => response.json()).then(jsonData => {
        let result = jsonData.Result;
        if(result){
            element.classList.add("liked");
        }
        else{
            element.classList.remove("liked");
        }
    })
}

function comment(event){
    let phpFileName = "./php/comment.php";
    let commentBoxElement = document.getElementById("commentbox");
    let commentCountElement = document.getElementById("commentCount");
    let UserId = commentBoxElement.getAttribute("userId");
    let PublicationId = commentBoxElement.getAttribute("publicationId");
    let comment = commentBoxElement.value;
    let jsonObject = {
        "comment":comment,
        "userId":UserId,
        "publicationId":PublicationId,
    }
    fetch(phpFileName,{
        method: "POST",
    headers: {
        'Content-Type': "application/json",
    },
    body: JSON.stringify(jsonObject)
    }).then(response => response.json()).then(jsonData =>{
        let result = jsonData.Result;
        if(result){
            addComment(comment);
            commentBoxElement.value = "";
            commentCountElement.value = ""+(parseInt(commentCountElement.value)+1);
        }
    })
}

function addComment(comment){
    let commentViewBox  = document.getElementById("commentViewBox");
    let commentElement = document.createElement("h4");
    commentElement.innerText = comment;
    commentViewBox.appendChild(commentElement);
}