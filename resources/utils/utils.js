// Word limit count
/* The function calculates the remaining character count in a textarea
with the id 'postDescription' and updates the text content of an element
with the id 'charCount' to display either the remaining characters or a
message indicating that the character limit has been reached.*/

function wordCount() {
    let textarea = document.getElementById("postDescription");
    let charCountElement = document.getElementById("charCount");
    let remainingChars = 1000 - textarea.value.length;

    if (remainingChars <= 0) {
        charCountElement.style.color = "red";
        charCountElement.textContent = "Character limit reached!";
    } else {
        charCountElement.style.color = ""; // Reset color
        charCountElement.textContent =
            "Characters remaining: " + remainingChars;
    }
}

// Image preview
/* listens for changes in the selected file of an input element with the id
'imgInp' and sets the 'src' attribute of an image element to the URL of the
selected file, allowing it to be displayed on the webpage dynamically.*/

function imagePreview() {
    document.getElementById("imgInp").onchange = (evt) => {
        const [file] = imgInp.files;
        if (file) {
            img.src = URL.createObjectURL(file);
        }
    };
}
