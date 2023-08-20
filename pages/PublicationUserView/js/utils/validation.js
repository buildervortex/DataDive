export function validateComment(commentElement ){
    if(commentElement.value.length<5)return false;
    return true;
}