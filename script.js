const form = document.querySelector('#form');
fullUrl = form.querySelector('#input');
shortenBtn = form.querySelector('#submit');
shortUrl = document.querySelector('.short-url');
longUrl = document.querySelector('.long-url');
url = document.querySelector('.url');
copyIcon = document.querySelector('.copy-icon');
form.onsubmit = (e) => {
    e.preventDefault();
}

// Если пользователь не зарегистрирован, то последняя сгенерированная ссылка храниться и берется из localStorage

if (localStorage.latestLink) {
    url.classList.remove('hidden');
    let links = JSON.parse( localStorage.latestLink );
    shortUrl.innerHTML = `<a href="http://localhost:3000/${links.short}">http://localhost:3000/${links.short}</a>`
    longUrl.innerHTML = links.long.substring(0, 25).concat('...');
}

copyIcon.onclick = () => {
    let shortUrlText = shortUrl.innerText;
    navigator.clipboard.writeText(shortUrlText);
}

// ajax запрос в url_control и отображение новой сгенерированной ссылки

shortenBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open('POST', '/app/url_control.php', true);
    xhr.onload = () => {
        if(xhr.readyState == 4 && xhr.status == 200) {
            let data = xhr.response;
            console.log(fullUrl.value);
            // Если длина ответа больше 5, то в ответе сообщение об ошибке
            if(data.length <= 5){
                localStorage.latestLink = JSON.stringify({long: fullUrl.value, short: data});
                shortUrl.innerHTML = `<a href="http://localhost:3000/${data}">http://localhost:3000/${data}</a>`
                longUrl.innerHTML = fullUrl.value.substring(0, 25).concat('...');
                fullUrl.value = '';
                url.classList.remove('hidden');
            } else {
                alert(data);
            }
        }
    };
    let formData = new FormData(form);
    xhr.send(formData);
}
