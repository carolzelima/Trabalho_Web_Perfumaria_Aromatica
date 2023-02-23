const carouselContainer = document.querySelector('.carousel-container');
const carouselItems = document.querySelectorAll('.carousel-item');
let carouselIndex = 0;

function showNext() {
  carouselItems[carouselIndex].classList.remove('active');
  carouselIndex = (carouselIndex + 1) % carouselItems.length;
  carouselItems[carouselIndex].classList.add('active');
}

setInterval(showNext, 5000);

function handlePrev() {
  if (carouselIndex > 0) {
    carouselIndex--;
    carouselContainer.scrollLeft -= carouselItemWidth;
  }
}

function handleNext() {
  if (carouselIndex < carouselItems.length - 1) {
    carouselIndex++;
    carouselContainer.scrollLeft += carouselItemWidth;
  }
}

document.querySelector('.carousel-prev').addEventListener('click', handlePrev);
document.querySelector('.carousel-next').addEventListener('click', handleNext);