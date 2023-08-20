import {initPdf} from "/shared/js/pdfFileView/pdfFileView.js";

export function pdfInit(){
    let pdfUrl = document.querySelector(".PdfThumbnail a").href;
    initPdf(pdfUrl);
}