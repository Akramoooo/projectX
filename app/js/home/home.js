let cardDesc = document.querySelectorAll(".card-desc");
let cardCategories = document.querySelectorAll(".categoryName");
let cardContainer = document.querySelector(".card-container");

// REDUCING DESCRIPTION OF POSTS
window.addEventListener("load", () => {
  cardDesc.forEach(element => {
    if (element.textContent.length > 30) {
      let text = element.textContent.substring(0, 30);
      console.log(text);
      element.textContent = `${text}  ...`;
    }
  });
});

// GIVING COLOR FOR CATEGORIES OF CARDS


window.addEventListener("load", () => {
  const filterSelect = document.getElementById("filter-select");
  filterSelect.value = "*"; //  Устанавливаем  значение  "Все"
  cardCategories.forEach(element => {
    switch (element.textContent) {
      case "редкий":
        element.style.color = "yellow";
        break;

      case "ядовитый":
        element.style.color = "purple";
        break;

      case "красная книга":
        element.style.color = "red";
        break;

      default:
        element.style.color = "gray";
        break;
    }
  });
});

// SELECTING CATEGORY



function getSelectedCategory(select){
  let selectCategoryId = select.options[select.selectedIndex].value;
  let obj = {"id": selectCategoryId};
  console.log(selectCategoryId);
  fetch("/get-category", {
    method: 'POST',
    body: JSON.stringify(obj),
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
    }
  }).then(response => {
      console.log('Response status:', response.status); // Log status
      return response.text(); // Change this to .text() to see the raw response
  }).then(resText => {
      console.log("Response body:", resText); // Log the raw response body
      try {
          const res = JSON.parse(resText); // Now parse the JSON
          if (res.status === 201) {
              console.log("Post successfully created!");
              cardsRender(res.data);
          }
      } catch (error) {
          console.error("Error parsing JSON:", error);
      }
  }).catch((error) => {
      console.error("Error fetching category:", error); // Log the error
  });

} 


function cardsRender(data){
  cardContainer.innerHTML = ``;
  data.forEach(element => {
    let card = document.createElement("div");
    card.classList.add("card");
    let img = document.createElement("img");
    img.src = "/images/green1.jpg";

    let ul = document.createElement("ul");
    ul.classList.add("card-info");
    ul.innerHTML = `  <li class="card-name">${element['name']}</li>
                <li class="card-price">${element['price']}</li>
                <li class="card-desc">${element['desc']}</li>
                <li>Category: <span class="categoryName">${element['category']}</span></li>`;

    let secondUl = document.createElement("ul");  
    secondUl.innerHTML = '<li><button>buy</button></li>';      

    if (ul.children[2].textContent.length > 30) {
      let text = ul.children[2].textContent.substring(0, 30);
      console.log(text);
      ul.children[2].textContent = `${text}  ...`;

    }

    ul.children[3].querySelector(".categoryName").textContent = element["category"] == 2 ? "редкий" : element["category"] === 3 ? "ядовитый" :  element["category"] === 4 ? "красная книга" : "обычный";
    console.log(ul.children[3]);
    
    ul.children[3].querySelector(".categoryName").style.color = element["category"] === 2 ? "yellow" : element["category"] === 3 ? "purple" :  element["category"] === 4 ? "red" : "gray";

    cardContainer.append(card);

    //  Добавляем  элементы  в  карточку
    card.append(img);
    card.append(ul);
    card.append(secondUl);
    
  });
}




// DATE AND ANIMATION

var timeElement = document.getElementById('currentTime');
setInterval(function () {
  var currentTime = new Date();
  timeElement.textContent = currentTime.toLocaleTimeString();
}, 1000);


const cards = document.querySelectorAll(".card");

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = 1;
            entry.target.style.transform = "translateY(0)";
        }
    });
}, { threshold: 0.5 }); //  Отображать  при  50%  видимости

cards.forEach((card) => {
    observer.observe(card);
});




