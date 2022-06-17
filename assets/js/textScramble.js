// ——————————————————————————————————————————————————
// TextScramble
// ——————————————————————————————————————————————————

class TextScramble {
    constructor(el) {
        this.el = el
        this.chars = '!<>-_\\/[]{}—=+*^?#________'
        this.update = this.update.bind(this)
    }
    setText(newText) {
        const oldText = this.el.innerText
        const length = Math.max(oldText.length, newText.length)
        const promise = new Promise((resolve) => this.resolve = resolve)
        this.queue = []
        for (let i = 0; i < length; i++) {
            const from = oldText[i] || ''
            const to = newText[i] || ''
            const start = Math.floor(Math.random() * 40)
            const end = start + Math.floor(Math.random() * 40)
            this.queue.push({ from, to, start, end })
        }
        cancelAnimationFrame(this.frameRequest)
        this.frame = 0
        this.update()
        return promise
    }
    update() {
        let output = ''
        let complete = 0
        for (let i = 0, n = this.queue.length; i < n; i++) {
            let { from, to, start, end, char } = this.queue[i]
            if (this.frame >= end) {
                complete++
                output += to
            } else if (this.frame >= start) {
                if (!char || Math.random() < 0.28) {
                    char = this.randomChar()
                    this.queue[i].char = char
                }
                output += `<span class="dud">${char}</span>`
            } else {
                output += from
            }
        }
        this.el.innerHTML = output
        if (complete === this.queue.length) {
            this.resolve()
        } else {
            this.frameRequest = requestAnimationFrame(this.update)
            this.frame++
        }
    }
    randomChar() {
        return this.chars[Math.floor(Math.random() * this.chars.length)]
    }
}
// ——————————————————————————————————————————————————
// Example
// ——————————————————————————————————————————————————

const phrases = [
    'Web',
    'Mobile',
    'IoT (Internet of Things)'
]

const phrases1 = [
    'Web',
    'Mobile'
]


const phrases2 = [
    'Industrial machines',
    'The automation of systems'
]

/**
 * Slide 1
 */

const el = document.querySelector('.text-display')
const fx = new TextScramble(el)

let counter = 0
const next = () => {
    fx.setText(phrases[counter]).then(() => {
        setTimeout(next, 800)
    })
    counter = (counter + 1) % phrases.length
}

/**
* Slide 2
*/

const el1 = document.querySelector('.text-display1')
const fx1 = new TextScramble(el1)
let counter1 = 0
const next1 = () => {
    fx1.setText(phrases1[counter1]).then(() => {
        setTimeout(next1, 800)
    })
    counter1 = (counter1 + 1) % phrases1.length
}

 
/**
* Slide 3
*/


const el2 = document.querySelector('.text-display2')
const fx2 = new TextScramble(el2)
let counter2 = 0
const next2 = () => {
    fx2.setText(phrases2[counter2]).then(() => {
        setTimeout(next2, 800)
    })
    counter2 = (counter2 + 1) % phrases2.length
}



next()
next1()
next2()