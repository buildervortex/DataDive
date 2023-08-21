import {validateComment} from "/pages/PublicationUserView/js/utils/validation.js";

function likeHandler(event){
    event.preventDefault();
    let userId = event.target.getAttribute("userId");
    let publicationId = event.target.getAttribute("publicationId");

    likeThePublication("/pages/PublicationUserView/php/like.php",userId,publicationId,event.target);
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

function comment(){
    let phpFileName = "/pages/PublicationUserView/php/comment.php";
    let commentBoxElement = document.getElementById("commentbox");
    let commentCountElement = document.getElementById("commentCount");
    let UserId = commentBoxElement.getAttribute("userId");
    let PublicationId = commentBoxElement.getAttribute("publicationId");
    let commentText = commentBoxElement.value;

    if(!validateComment(commentBoxElement)){
        commentBoxElement.value="";
        return;
    }
    let jsonObject = {
        "comment":commentText,
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
            addComment(commentText);
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

export function setupHandlers(commentButtonSelector=".Comments #addComment",LikeButtonSelector=".About #likeButton"){
    let commentButtonElement = document.querySelector(commentButtonSelector);
    let likeButtonElement = document.querySelector(LikeButtonSelector);
    if(commentButtonElement == null)return;
    if(likeButtonElement == null)return;

    commentButtonElement.addEventListener("click",()=>{
        comment();
    });
    likeButtonElement.addEventListener("click",(event)=>{
        likeHandler(event);
    });
}