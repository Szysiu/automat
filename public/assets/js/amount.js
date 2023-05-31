document.addEventListener('DOMContentLoaded', function () {
    const incButton = document.querySelector('#inc');
    const decButton = document.querySelector('#dec');
    const amount = document.querySelector('#newAmount');

    incButton.addEventListener('click', function () {
        if (amount.value < 20) {
            amount.value = parseInt(amount.value) + 1;
        }
    });

    decButton.addEventListener('click', function () {
        if (amount.value >= 1) {
            amount.value = parseInt(amount.value) - 1;
        }
    });
});
