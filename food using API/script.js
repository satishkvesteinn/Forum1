
// all variables are declared here
const searchBtn = document.getElementById('searchRecipeBtn');
const mealList = document.getElementById('meal');
const mealDetailsContant = document.querySelector('.meal-details-content');
const recipeCloseBtn = document.getElementById('recipe-close-btn');
let searchMeal = document.getElementById('search-meal');
let category = document.getElementById('category');
const mealCategory1 = document.getElementById('mealcategory1');

// all click event and functions are declared here
searchBtn.addEventListener('click', search);
mealList.addEventListener('click', getMealRecipe);
recipeCloseBtn.addEventListener('click', function() {
    mealDetailsContant.parentElement.classList.remove('showRecipe');
});


// fetching category with API 
fetch(`https://www.themealdb.com/api/json/v1/1/categories.php`).then(response => response.json()).then(data => {
    console.log(data.categories);
    let html = "";
    if (data.categories) {    
          data.categories.forEach((category) => {
            html += `
        <div class=" row d-flex justify-content-center mx-0 my-3 px-2 py-5" style=" box-shadow: 0px 0px 5px 0px grey;">
          <div class="col-sm-12 col-lg-5 text-sm-center text-lg-start align-self-center">
            <img src="${category.strCategoryThumb}" class="img-fluid" alt="">
          </div>
          <div class="col-sm-12 col-lg-7 text-sm-center text-lg-start align-self-center categoryTittle">
            <h3>${category.strCategory}</h3>
            <p>${category.strCategoryDescription}</p>
          </div>
        </div>`;
        })
    }
    mealCategory1.innerHTML = html;
})





// check function start
function search(){
    let searchRecipeText = document.getElementById('searchRecipeText').value.trim();
    // fetching recipe with API
    fetch(`https://www.themealdb.com/api/json/v1/1/filter.php?i=${searchRecipeText}`).then(response => response.json()).then(data => {
        let html = "";
        if (data.meals) {
            data.meals.forEach(meal => {
                html += `
                <div class="meal-item" data-id = "${meal.idMeal}">
               <div class="meal-img text-center">
                   <img src="${meal.strMealThumb}" class="img-fluid" alt="food">
               </div>
               <div class="meal-name text-center">
                   <h2>${meal.strMeal}</h2>
                   <a href="" class="recipe-btn">Get recipe</a>
               </div>
           </div>`;
            })
            mealList.classList.remove('not-found');
            
        } else {
            html = "Sorry, no results are found";
            mealList.classList.add('not-found');
        }
        window.scrollTo(0,500);
        category.style.display = "none";
        searchMeal.style.display = "block";
        mealList.innerHTML = html;

    })
}

//  check function end

// getMealRecipe function start
function getMealRecipe(e){
    e.preventDefault();
    if (e.target.classList.contains('recipe-btn')) {
        let mealItem = e.target.parentElement.parentElement;
        // fetching meals details with API
        fetch(`https://www.themealdb.com/api/json/v1/1/lookup.php?i=${mealItem.dataset.id}`).then(response => response.json()).then(data => mealRecipeModal(data.meals));

    }
}

function mealRecipeModal(meal){
    meal = meal[0]
    let html = ` 
    <h2 class="recipe-tite">${meal.strMeal}</h2>
    <p class="recipe-category">${meal.strCategory}</p>
    <div class="recipe-instruct">
        <h3>Instruction</h3>
        <p>${meal.strInstructions}</p>
    </div>
    <div class="recipe-meal-img">
        <img src="${meal.strMealThumb}" alt="">
    </div>
    <div class="recipe-link">
        <a href="${meal.strYoutube}" target="-blank">watch video</a>
    </div>`;
    mealDetailsContant.innerHTML = html;
    mealDetailsContant.parentElement.classList.add('showRecipe');
}
// getMealRecipe function end