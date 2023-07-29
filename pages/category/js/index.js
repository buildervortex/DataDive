import {navBarInit} from "../../../../js/other/navBar/navBar.js";
import {setUpTheCategorySelection} from "../../../../js/other/categorySelect/index.js";

setUpTheCategorySelection();

navBarInit();
const cardData = [
    {
      title: 'Card 1',
      imageSrc: 'image1.jpg',
      thumbnailSrc: 'thumbnail1.jpg',
      paragraph: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
      likeCount: 1,
      commentCount: 1,
    },
    {
      title: 'Card 2',
      imageSrc: 'image2.jpg',
      thumbnailSrc: 'thumbnail2.jpg',
      paragraph: 'Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
      likeCount: 1,
      commentCount: 1,
    },
    // Add more card data here...
  ];
  
  function createCard(cardData) {
    const cardContainer = document.getElementById('cardContainer');
  
    const card = document.createElement('div');
    card.classList.add('card');
  
    const img = document.createElement('img');
    img.src = cardData.imageSrc;
    card.appendChild(img);
  
    const h3 = document.createElement('h3');
    h3.textContent = cardData.title;
    card.appendChild(h3);
  
    const thumbnail = document.createElement('img');
    thumbnail.src = cardData.thumbnailSrc;
    card.appendChild(thumbnail);
  
    const p = document.createElement('p');
    p.textContent = cardData.paragraph;
    card.appendChild(p);
  
    const rating = document.createElement('div');
    rating.classList.add('rating');
  
    const like = document.createElement('div');
    like.classList.add('likes');
  
    const likeImg = document.createElement('img');
    likeImg.src = 'like.png';
    like.appendChild(likeImg);
  
    const likeCount = document.createElement('span');
    likeCount.classList.add('like-count');
    likeCount.textContent = cardData.likeCount;
    like.appendChild(likeCount);
  
    rating.appendChild(like);
  
    const comment = document.createElement('div');
    comment.classList.add('comments');
  
    const commentImg = document.createElement('img');
    commentImg.src = 'comment.png';
    comment.appendChild(commentImg);
  
    const commentCount = document.createElement('span');
    commentCount.classList.add('comment-count');
    commentCount.textContent = cardData.commentCount;
    comment.appendChild(commentCount);
  
    rating.appendChild(comment);
  
    card.appendChild(rating);
  
    cardContainer.appendChild(card);
  }
  
  // Create cards dynamically using the cardData array
  // Array of objects representing each card
let cards = [
    { likeCount: 1, commentCount: 1 },
    { likeCount: 1, commentCount: 1 },
    // Add more objects for additional cards
];

function incrementLikeCount(cardIndex) {
    cards[cardIndex].likeCount++;
    document.getElementById("likeCount" + cardIndex).textContent = cards[cardIndex].likeCount;
}

function incrementCommentCount(cardIndex) {
    cards[cardIndex].commentCount++;
    document.getElementById("commentCount" + cardIndex).textContent = cards[cardIndex].commentCount;
}

 

function handleMainCategoryHover() {
    const additionalOptionElement = document.getElementById('additionalOption');
    additionalOptionElement.style.display = 'flex';
}

function handleSubCategoryHover() {
    const additionalOptionElement = document.getElementById('additionalOption');
    additionalOptionElement.style.display = 'flex';
}

    function handleSortHover() {
        const additionalOption = document.getElementById("additionalOption");
        const checkboxOptions = document.getElementById("checkboxOptions");
        additionalOption.style.display = "none";
        checkboxOptions.style.display = "none";
    }

    function handleSortChange() {
        const selectedValue = document.querySelector('select[name="sort"]').value;
        const additionalOption = document.getElementById("additionalOption");
        const checkboxOptions = document.getElementById("checkboxOptions");

        if (selectedValue === "2") {
            // If Main Category is selected, display the date option and show the select element.
            additionalOption.style.display = "block";
            checkboxOptions.style.display = "none";
        } else if (selectedValue === "3") {
            // If Sub Category is selected, display the checkbox options and show the div.
            additionalOption.style.display = "none";
            checkboxOptions.style.display = "block";
        } else {
            // If any other option is selected, hide both the date option and checkbox options.
            additionalOption.style.display = "none";
            checkboxOptions.style.display = "none";
        }
    }



    function handleSortHover() {
        const additionalOption = document.getElementById("additionalOption");
        const checkboxOptions = document.getElementById("checkboxOptions");
        additionalOption.style.display = "none";
        checkboxOptions.style.display = "none";
    }

    function handleSortChange() {
        const selectedValue = document.querySelector('select[name="sort"]').value;
        const additionalOption = document.getElementById("additionalOption");
        const checkboxOptions = document.getElementById("checkboxOptions");

        if (selectedValue === "1") {
            // If Selection is selected, display the date and creative calendar options.
            additionalOption.style.display = "block";
            checkboxOptions.style.display = "none";
        } else if (selectedValue === "2") {
            // If Main Category is selected, display the global option.
            additionalOption.style.display = "block";
            checkboxOptions.style.display = "none";
        } else if (selectedValue === "3") {
            // If Sub Category is selected, display the radio buttons for like, rating, and comment.
            additionalOption.style.display = "none";
            checkboxOptions.style.display = "block";
        } else {
            // If any other option is selected, hide both the date and checkbox options.
            additionalOption.style.display = "none";
            checkboxOptions.style.display = "none";
        }
    }

    function handleSelectionHover() {
        const additionalOption = document.getElementById("additionalOption");
        const checkboxOptions = document.getElementById("checkboxOptions");
        additionalOption.style.display = "block";
        checkboxOptions.style.display = "none";
    }

    function handleMainCategoryHover() {
        const additionalOption = document.getElementById("additionalOption");
        const checkboxOptions = document.getElementById("checkboxOptions");
        additionalOption.style.display = "block";
        checkboxOptions.style.display = "none";
    }

    function handleSubCategoryHover() {
        const additionalOption = document.getElementById("additionalOption");
        const checkboxOptions = document.getElementById("checkboxOptions");
        additionalOption.style.display = "none";
        checkboxOptions.style.display = "block";
    }




    const dateCells = document.querySelectorAll('.date');
    const currentMonthSpan = document.getElementById('currentMonth');

    function updateCalendar() {
        const currentDate = new Date();
        const currentYear = currentDate.getFullYear();
        const currentMonth = currentDate.getMonth();
        const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
        const firstDayOfMonth = new Date(currentYear, currentMonth, 1).getDay();

        // Update the calendar header with the current month and year
        const months = [
            'January', 'February', 'March', 'April', 'May', 'June',
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        currentMonthSpan.textContent = `${months[currentMonth]} ${currentYear}`;

        // Clear any previous dates and placeholders
        dateCells.forEach((cell) => {
            cell.textContent = '';
            cell.classList.remove('selected');
        });

        // Populate the calendar with dates
        let date = 1;
        for (let i = firstDayOfMonth; i < firstDayOfMonth + daysInMonth; i++) {
            dateCells[i].textContent = date;
            date++;
        }
    }

    dateCells.forEach((cell) => {
        cell.addEventListener('click', handleDateSelection);
    });

    const searchButton = document.querySelector('.search-button');
searchButton.addEventListener('click', handleSearchButtonClick);