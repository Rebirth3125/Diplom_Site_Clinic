// document.addEventListener('DOMContentLoaded', function () {
//   const searchForm = document.getElementById('searchForm');

//   if (searchForm) {
//     const searchInput = searchForm.querySelector('input');

//     searchForm.addEventListener('submit', function (event) {
//       event.preventDefault();

//       const searchTerm = searchInput.value.trim().toLowerCase();

//       if (searchTerm.length > 0) {
//         const searchData = {
//           searchTerm: searchTerm,
//         };

//         sessionStorage.setItem('searchData', JSON.stringify(searchData));

//         window.location.href = `search.html?q=${encodeURIComponent(searchTerm)}`;
//       }
//     });
//   }
// });