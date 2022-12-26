(function sorted() {
    let checkedRadioButton = document.querySelector('.sort-buttons input[name="sort"][type=radio]:checked');

    if (!checkedRadioButton) {
        checkedRadioButton = document.querySelector('.sort-buttons input[name="sort"][type=radio][value="total_sum"]');
        checkedRadioButton.setAttribute('checked', true);
    }

    let tableColumn = document.querySelector('th.' + checkedRadioButton.value);
    tableColumn.classList.add('sorted');
})();



