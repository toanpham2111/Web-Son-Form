/**
 * @package     Wordpress.Site
 * @subpackage  Templates.NoName
 *
 * @copyright   Copyright (C) 2020 NoName. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
import { Swiper } from 'swiper/bundle';
import { Pagination, Navigation } from 'swiper';
// configure Swiper to use modules
Swiper.use([Pagination]);
Swiper.use([Navigation]);
import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/bundle';

// import Swiper JS

const swiper = new Swiper('.swiper-slider-thumb', {
  spaceBetween: 5,
  slidesPerView: 7,
  freeMode: true,
  watchSlidesProgress: true,
});
const swiper2 = new Swiper('.swiper-slider-product', {
  spaceBetween: 0,
  loop: true,
  pagination: {
    el: '.swiper-pagination',
    clickable: true,
  },
  thumbs: {
    swiper: swiper,
  },
});
