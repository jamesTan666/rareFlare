const app = Vue.createApp({
    data() {
        return {
            toggleNavState: false,
            toggleNavStateMobile: false,
            mobileSearchIcon: "search", 
            notifications: [],
            users: [], 
            editor: null, 
            toastNum: 0, 
            portTitle: "", 
            portSum: "", 
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
        publish() {
            let content = this.editor.getContents();
            let url = "../api/postPortfolio.php";

            axios.post(url, {
                data: {
                    title: this.portTitle,
                    summary: this.portSum, 
                    authors: [this.users.name], 
                    doc: content
                }
            })
            .then((res) => {
                if (res.data.status.toLowerCase() == "success") {
                    let temp = window.location.href.lastIndexOf("/");
                    window.location.href = window.location.href.slice(0, temp) + "/profile_page.php";
                } else {
                    this.makeToast();
                }
            })
            .catch((err) => {
                this.makeToast(err.message);
            })
        }, 
        makeToast(msg = null) {
            let timestamp = new Date();
            let message = "";

            timestamp = timestamp.getHours().toString() + ":" + ( (timestamp.getMinutes().toString().length == 1) ? ("0" + timestamp.getMinutes().toString()) : (timestamp.getMinutes().toString()))
            if (msg == null) {
                message = "<span class='text-danger'>Something went wrong, Was not able to save and post write-up. </span>";
            } else {
                message = "<span class='text-danger'>An error occured: " + msg + " </span>";
            }

            let temp = `
            <div id="toast-${this.toastNum}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">RevFlair</strong>
                    <small class="text-muted">${timestamp}</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body bg-white">
                    ${message}
                </div>
            </div>
            `;

            document.getElementById("inform-user").innerHTML += temp;
            let toast = new bootstrap.Toast(document.getElementById(`toast-${this.toastNum}`));
            toast.show();

            this.toastNum++;
        }
    }, 
    computed() {
    }, 
    created() {
        let url = '../api/user.php';
        
        // Use Axios
        axios.get(url)
        .then((response) => {
            this.users = response.data.data;
            console.log(this.users);
        })
        .catch((error) => {
            this.users = {
                entry : 'There was an error: '
            };
        });
    }, 
    mounted() {
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });

        // Populate toolbar with several options
        var toolbarOptions = [
            
            ['bold', 'italic', 'underline', 'strike'], // toggled buttons
            ['blockquote', 'code-block'],
            [ { 'header' : 1 }, { 'header' : 2} ], // custom button values
            [ {'list': 'ordered'}, {'list': 'bullet'}],
            [ {'script': 'sub'}, {'script': 'super'}], // superscript/subscript
            [{ 'indent': '-1'}, { 'indent': '+1' }], // outdent/indent
            [{ 'direction': 'rtl' }], // text direction
            [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
            ['image', 'video', 'formula'],  

            [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
            [{ 'font': [] }],
            [{ 'align': [] }],

            ['clean']   
        ];

        // Quill editor
        var quill = new Quill('#editor', {
            modules: {
                toolbar: toolbarOptions
            },
            theme: 'snow'
        });
        this.editor = quill;
    }
});

app.mount("#app");