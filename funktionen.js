// Fade -------------------------------------------------------
function toggleFadeIn(element) {
    //element.style.display = 'block'; // Block setzen, bevor die Klasse hinzugefügt
    // oberes ausgestellt wegen verursachten layoutproblemen
    requestAnimationFrame(() => {
        element.classList.add('visible');
    });
}
function toggleFadeOut(element) {
    requestAnimationFrame(() => {
        element.classList.remove('visible');
    });
    element.addEventListener('transitionend', function handleTransitionEnd() {
        element.removeEventListener('transitionend', handleTransitionEnd);
    });
}