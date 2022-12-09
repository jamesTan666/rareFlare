const app = Vue.createApp({
    data() {
        return {
            toggleNavState: false,
            toggleNavStateMobile: false,
            mobileSearchIcon: "search",
            notifications: [], 
            currChat: ''
        };
    }, 
    methods: {
        toggleNav() {
            /**
             * Toggles the side navbar when the viewport is >small breakpoint size
             */
            let bodyElem = document.querySelector("#main-content");
            if (!this.toggleNavState) {
                let prevElem = document.querySelector("#side-nav-short");
                setTimeout(() => {
                    prevElem.style.transform = "translate(-100px)";

                    setTimeout(() => {
                        prevElem.style.display = "none";
    
                        let currElem = document.querySelector("#side-nav");
                        currElem.style.display = "block";
                        setTimeout(() => {
                            currElem.style.transform = "translate(195px)";
                            bodyElem.style.transform = "translate(60px)";
                        }, 250);
                    }, 500);
                }, 0);
                this.toggleNavState = !this.toggleNavState;
            } else {
                let prevElem = document.querySelector("#side-nav");
                setTimeout(() => {
                    prevElem.style.removeProperty("transform");
                    bodyElem.style.removeProperty("transform");

                    setTimeout(() => {
                        prevElem.style.display = "none";
    
                        let currElem = document.querySelector("#side-nav-short");
                        currElem.style.display = "block";
                        setTimeout(() => {
                            currElem.style.removeProperty("transform");
                        }, 250);
                    }, 500);
                }, 0); 
                this.toggleNavState = !this.toggleNavState;
            }
        }, 
        toggleNavMobile() {
            /**
             * Toggle the side navbar when the viewport is <=small breakpoint
             */
            let elem = document.querySelector("#side-nav-mobile");
            let bgElem = document.querySelector("#mobile-modal-bg");
            if (this.toggleNavStateMobile) {
                elem.style.display = "block";

                setTimeout(() => {
                    elem.style.transform = "translate(300px)";
                    bgElem.style.display = "block";
                }, 0);
                this.toggleNavStateMobile = !this.toggleNavStateMobile;
            } else {
                setTimeout(() => {
                    elem.style.removeProperty("transform");
                    setTimeout(() => {
                        elem.style.display = "none";
                        bgElem.style.display = "none";
                    }, 250);
                }, 0);
                this.toggleNavStateMobile = !this.toggleNavStateMobile;
            }
        }, 
        mobileSearch() {
            /**
             * Toggles the search bar when the viewport is at <=medium breakpoint
             */
            let elem = document.querySelector("#mobile-search-bar");
            if (this.mobileSearchIcon === "search") {
                elem.style.display = "block";
                this.mobileSearchIcon = "close";
            } else {
                elem.style.display = "none";
                this.mobileSearchIcon = "search";
            }
        }, 
        sendMessage(e) {
            let elem = document.getElementById("chat-body"); 
            let time = new Date(); 
            time = time.getHours() + ":" + time.getMinutes().toString();
            elem.innerHTML += `<div class="receiver align-self-end py-2 px-3 mb-2 rounded-3 d-flex flex-column">
                <p class="chat-msg mb-2">${this.currChat}</p>
                <span class="chat-time align-self-end fst-italic">${time}</span>
            </div>`; 

            document.getElementById("test1").innerText = this.currChat;
            document.getElementById("test2").innerText = time;
        }
    }, 
    computed() {
    }, 
    mounted() {
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    }
});

app.component("messageBubble", {
    props: ['body', 'time', 'isSender'], 
    template: `
    <div :class="{receiver: true, "align-self-start": isSender, "py-2": true, "px-3": true, "mb-2": true, "rounded-3": true, "d-flex": true, "flex-column": true}">
        <p class="chat-msg mb-2">{{ body }}</p>
        <span class="chat-time align-self-end fst-italic">{{ time }}</span>
    </div>
    `, 
})

app.mount("#app");