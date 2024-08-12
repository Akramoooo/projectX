let input = document.querySelector(".search-li>input");

input.addEventListener( "input" ,() => {
    let obj = {"word": input.value};
    fetch('/search', {
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
          console.log("Response body: Success"); // Log the raw response body
          try {
              const res = JSON.parse(resText); // Now parse the JSON
              if (res.status === 201) {
                  console.log("Post successfully created!");
                  renderCards(res.cards);
              }
          } catch (error) {
              console.error("Error parsing JSON:", error);
          }
      }).catch((error) => {
          console.error("Error fetching category:", error); // Log the error
      });
});

function renderCards(data)
{
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