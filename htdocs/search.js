document.addEventListener('DOMContentLoaded', function () {
  const searchForm = document.getElementById('searchForm');
  const searchInput = searchForm.querySelector('input');

  searchForm.addEventListener('submit', function (event) {
    event.preventDefault();

    const searchTerm = searchInput.value.trim().toLowerCase();

    if (searchTerm.length > 0) {
      performSearch(searchTerm);
    }
  });

  function performSearch(searchTerm) {
    fetch(`search.php?q=${encodeURIComponent(searchTerm)}`)
      .then(response => response.json())
      .then(data => {
        console.log('Search results:', data);
        window.location.href = `search.html?results=${encodeURIComponent(JSON.stringify(data))}`;
      })
      .catch(error => {
        console.error('Error fetching search results:', error);
      });
  }
});
