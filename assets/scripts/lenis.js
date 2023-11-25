import Lenis from '@studio-freight/lenis'
const lenis = new Lenis({duration: 1.6});

lenis.on('scroll', (e) => {
})

function raf(time) {
    lenis.raf(time)
    requestAnimationFrame(raf)
}

requestAnimationFrame(raf)
