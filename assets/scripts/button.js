const likedButton = document.querySelector('.js-liked');
const doneButton = document.querySelector('.js-done');

if (likedButton) likedButton.addEventListener('click', liked);
if (doneButton) doneButton.addEventListener('click', liked);

function liked(e) {
    e.preventDefault();

    const likedLink = e.currentTarget;
    const link = likedLink.href;
    // Send an HTTP request with fetch to the URI defined in the href
    try {
        fetch(link)
            // Extract the JSON from the response
            .then(res => res.json())
            // Then update the icon
            .then(data => {
                const likedIcon = likedLink.firstElementChild;
                if (data.isTrue) {
                    likedIcon.classList.remove("fill-dark");
                    likedIcon.classList.add("fill-orange");
                } else {
                    likedIcon.classList.remove("fill-orange");
                    likedIcon.classList.add("fill-dark");
                }
            });
    } catch (err) {
        console.error(err);
    }
}