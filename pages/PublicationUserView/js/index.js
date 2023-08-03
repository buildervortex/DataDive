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
    let likeElement = document.getElementById("likeCountElement");
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
            likeElement.value = (parseInt(likeElement.value)+1)+"";
        }
        else{
            element.classList.remove("liked");
            likeElement.value = (parseInt(likeElement.value)-1)+"";
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
    let commentElement = document.createElement("div");
    commentElement.classList.add("comment");
    let imageElement = document.createElement("img");
    imageElement.src = "./icon/comment.png";
    let commentParagraphElement = document.createElement("p");
    commentParagraphElement.innerHTML = comment;

    commentElement.appendChild(imageElement);
    commentElement.appendChild(commentParagraphElement);
    
    commentViewBox.appendChild(commentElement);
}

function profileClick(authorId){
    window.location.href="/pages/AuthorProfileUserView/index.php?AID="+authorId;
}