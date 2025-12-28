import { icon } from '@fortawesome/fontawesome-svg-core';
export function fontAwesomeLoad(element, elementIcon, domNode = false) {
  let list;
  if (domNode) {
    list = element;
    list.appendChild(icon(elementIcon).node[0]);
  } else {
    list = document.querySelectorAll(element);
    if (list) {
      list.forEach(function (item, index) {
        item.appendChild(icon(elementIcon).node[0]);
      });
    }
  }
}
