/*Advanced Filter*/
var btn = document.querySelector('.advanced_hidden');
var container = document.querySelector('.advanced_filter');

btn.addEventListener('click', function () {
    if(container.style.display === 'none'){
        container.style.display = 'flex';
    }else{
        container.style.display = 'none';
    }
});
