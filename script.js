let menuBtn = document.getElementById('menu-btn');
let navbar = document.querySelector('.header .navbar');

menuBtn.addEventListener('click', () => {
  navbar.classList.toggle('active');
});








  const homeSlider = new Swiper(".home-slider", {
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });







  let loadMoreBtn = document.querySelector('.package .load-more .btn');
  let boxContainer = document.querySelector('.package .box-container');
  let boxes = [...boxContainer.querySelectorAll('.box')];
  let currentItem = 0;
  const itemsPerLoad = 3;

  loadMoreBtn.onclick = () => {
    for (let i = currentItem; i < currentItem + itemsPerLoad; i++) {
      if (i >= boxes.length) {
        loadMoreBoxes();
        break;
      }
      boxes[i].style.display = 'inline-block';
    }
    currentItem += itemsPerLoad;
  };

  function loadMoreBoxes() {



    let clonedBoxes = boxes.slice(0, itemsPerLoad).map(box => box.cloneNode(true));
    boxContainer.append(...clonedBoxes);


    boxes = [...boxContainer.querySelectorAll('.box')];
  }


  for (let i = 0; i < Math.min(itemsPerLoad, boxes.length); i++) {
    boxes[i].style.display = 'inline-block';
  }
  currentItem += itemsPerLoad;




   // JavaScript to set the minimum departure date based on the selected arrival date
   const arrivalDateInput = document.getElementById('arrivalDate');
   const departureDateInput = document.getElementById('departureDate');

   arrivalDateInput.addEventListener('change', function () {
       const selectedArrivalDate = new Date(arrivalDateInput.value);
       const minDepartureDate = new Date(selectedArrivalDate);
       minDepartureDate.setDate(selectedArrivalDate.getDate() + 1);
       const minDepartureDateString = minDepartureDate.toISOString().split('T')[0];

       departureDateInput.min = minDepartureDateString;
   });








