export function initPdf(pathToPdf) {
    document.addEventListener("DOMContentLoaded", function () {
        const pdfjsLib = window['pdfjs-dist/build/pdf'];
        pdfjsLib.GlobalWorkerOptions.workerSrc = 'https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.worker.min.js';

        const pdfContainer = document.querySelector(".pdfView .pdf-container")
        const canvas = document.querySelector('.pdf-container #pdf-viewer');
        let zoomInButonElement = document.querySelector(".pdfView .zoomButtons #zoomIn");
        let zoomOutButonElement = document.querySelector(".pdfView .zoomButtons #zoomOut");

        zoomInButonElement.addEventListener("click",()=>{
            canvas.style.height=(canvas.clientHeight+100)+"px";
        });
        zoomOutButonElement.addEventListener("click",()=>{
            canvas.style.height=(canvas.clientHeight-100)+"px";
        });


        pdfjsLib.getDocument(pathToPdf).promise.then(function (pdfDoc) {
            let previousButtonElement = document.querySelector(".pdfView #previous")
            let nextButtonElement = document.querySelector(".pdfView #next")
            let cuttentPage = 1;
            let pageCount = pdfDoc.numPages;

            if (cuttentPage == 1) {
                pdfDoc.getPage(cuttentPage).then(function (page) {
                    const scale = 1.5;
                    const viewport = page.getViewport({ scale: scale });

                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext);
                    pdfContainer.scrollTop = 0;
                });
            }
            previousButtonElement.addEventListener("click",()=>{
                if(cuttentPage>1){
                    cuttentPage--;
                }
                pdfDoc.getPage(cuttentPage).then(function (page) {
                    const scale = 1.5;
                    const viewport = page.getViewport({ scale: scale });

                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext);
                    pdfContainer.scrollTop = 0;
                });
            });

            nextButtonElement.addEventListener("click",()=>{
                if(cuttentPage<pageCount){
                    cuttentPage++;
                }
                pdfDoc.getPage(cuttentPage).then(function (page) {
                    const scale = 1.5;
                    const viewport = page.getViewport({ scale: scale });

                    const context = canvas.getContext('2d');
                    canvas.height = viewport.height;
                    canvas.width = viewport.width;

                    const renderContext = {
                        canvasContext: context,
                        viewport: viewport
                    };
                    page.render(renderContext);
                    pdfContainer.scrollTop = 0;
                });
            });
        });
    });

}