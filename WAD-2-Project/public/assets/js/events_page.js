const app = Vue.createApp({
    data() {
        return {
            toggleNavState: false,
            toggleNavStateMobile: false,
            mobileSearchIcon: "search", 
            pageError: false,
            competitions: [], 
            notifications: [],
            toastNum: 0, 
            competitionsPage: 0,
            competitionsLength: 0, 
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
        searchKeyword() {
            var allHackathons = Array.from(document.getElementsByClassName("hackathon-card"))
            var search = document.getElementById("keyword-search-input").value.toLowerCase()
            allHackathons.map(x => { 
                hackathonName = x.getAttribute("data-value").toLowerCase()
                if (hackathonName.includes(search)) {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            });
        }, 
        getDate(dateStr, isStart = false) {
            if (dateStr == null) {
                return "-";
            }

            let dateArr = dateStr.split(" ");
            let monthNames = [
                "January", 
                "February", 
                "March", 
                "April", 
                "May", 
                "June", 
                "July", 
                "August", 
                "September", 
                "October", 
                "November", 
                "December"
            ];
            dateArr[1] = "T" + dateArr[1] + "+08:00";
            let resultDate = dateArr.join("");

            resultDate = new Date(resultDate);
            let result = null;
            if (isStart) {
                result = monthNames[resultDate.getMonth()];
                result += " " + resultDate.getFullYear();
            } else {
                result = resultDate.getDate();
                result += " " + monthNames[resultDate.getMonth()];
                result += " " + resultDate.getFullYear();
            }

            return result;
        }, 
        getStatus(dateStart, dateEnd) {
            let dateArr = dateStart.split(" ");
            dateArr[1] = "T" + dateArr[1] + "+08:00";
            let start = dateArr.join("");
            start = new Date(start);

            let current = new Date();
            let end = null;

            if (dateEnd != null) {
                dateArr = dateEnd.split(" ");
                dateArr[1] = "T" + dateArr[1] + "+08:00";
                end = dateArr.join("");
                end = new Date(end);
            } else if (start > current) {
                return "Coming Soon!";
            } else {
                return "Open for Registration";
            }


            if (end < current) {
                return "Closed";
            } else if (start > current) {
                return "Coming Soon!";
            } else {
                return "Open for Registration";
            }
        }, 
        joinCompetition(e) {
            let url = "../api/joinCompetition.php"; 
            let cid = Number.parseInt(e.target.getAttribute("comp-id"));

            axios.post(url, {
                competition_id: cid
            })
            .then((res) => {
                this.makeToast("pass", res.data);
            })
            .catch((err) => {
                this.makeToast("error", err.message);
            });
        }, 
        makeToast(status, data) {
            let timestamp = new Date();
            let message = "";

            timestamp = timestamp.getHours().toString() + ":" + ( (timestamp.getMinutes().toString().length == 1) ? ("0" + timestamp.getMinutes().toString()) : (timestamp.getMinutes().toString()))
            if (status === "pass") {
                if (data.status.toLowerCase() === "success") {
                    message = "<span class='text-success'>Competition joined successfully. </span>";
                } else {
                    message = "<span class='text-danger'>Something went wrong, was not able to join the competition. </span>";
                }
            } else {
                message = "<span class='text-danger'>An error occured: " + data + " </span>";
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
        },
        getTruncPaginate(length, page) {
            let result = [];
            let right = length - page;
            if (page <= 11) {
                for (let i = 1; i <= page; i++) {
                    result.push(i);
                }
            } else {
                let temp = page - 10;
                result.push("...");
                for (let i = temp; i <= page; i++) {
                    result.push(i);
                }
            }
            if (right <= 10) {
                for (let i = page + 1; i <= length; i++) {
                    result.push(i);
                }
            } else {
                let temp = page + 10;
                for (let i = page + 1; i <= temp; i++) {
                    result.push(i);
                }
                result.push("...");
            }
            return result;
        }, 
        updateCompetitions(page) {
            let url = "../api/competition.php";

            axios.get(url, {
                params: {
                    type: "all"
                }
            })
            .then((res) => {
                this.competitions = res.data.data;
                this.competitionsPage = res.data.page;
                this.competitionsLength = res.data.total;
            })
            .catch((err) => {
                this.pageError = true;
                console.error(err.message);
            })
        }, 
        setUpModal() {
            var exampleModal = document.getElementById("exampleModal");
            exampleModal.addEventListener("show.bs.modal", function (event) {
                // Button that triggered the modal
                var button = event.relatedTarget;
                // Extract info from data-bs-* attributes
                var hackathonName = button.getAttribute("data-bs-hackathonName");
                var hackathonId = button.getAttribute("data-bs-id");
                var link = button.getAttribute("data-bs-link");
                var modalTitle = exampleModal.querySelector(".modal-title");
                var hackathon_telegram_id = 13;
                modalTitle.textContent = `${hackathonName}`;
                document.getElementById(`modal_description`).innerText = document.getElementById(`${hackathonName}_description`).innerText;
                document.getElementById(`modal_image`).src = document.getElementById(`${hackathonName}_image`).src;

                document.getElementById(`modal_link`).href = link;
                document.getElementById(`modal_link`).rel = "nofollow";

                document.getElementById(`modal_color_exp`).innerText = document.getElementById(`${hackathonName}_color_exp`).innerText;
                document.getElementById(`modal_color_type`).innerText = document.getElementById(`${hackathonName}_color_type`).innerText;
                document.getElementById(`modal_color_team`).innerText = document.getElementById(`${hackathonName}_color_team`).innerText;

                document.getElementById(`join-comp-btn`).setAttribute("comp-id", hackathonId);
            }); 
        }
    }, 
    computed() {
    }, 
    mounted() {
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    }, 
    created() {
        let url = "../api/competition.php";

        axios.get(url, {
            params: {
                type: "all"
            }
        })
        .then((res) => {
            this.competitions = res.data.data;
            this.competitionsPage = res.data.page;
            this.competitionsLength = res.data.total;
        })
        .then(() => {
            this.setUpModal();
        })
        .catch((err) => {
            this.pageError = true;
            console.error(err.message);
        })
    }
});

app.component('card', {
    props: ['title' , 'header', 'description', 'difficulty', 'type', 'team', 'status', 'link', 'image', 'register_by', 'submit_by', 'start_by', 'id'],
    methods: {
        getColor(status) {
            switch (status) {
                case "Open for Registration":
                    return "background-color: #00ff88!important";
                case "Closed":
                    return "background-color: #ff0000!important";
                case "Coming Soon!":
                    return "background-color: #868686!important";
            }
        }
    },
    template: `<div class="col px-3 hackathon-card" v-bind:data-value="title" >
    <div class="card h-100">
        <div class="card-header text-center text-bold text-white" :style="getColor(status)">{{ status }}</div>
            <div class="row g-0 mx-3">
            <div class="mx-auto text-center" style="height:200px;">
                <img v-bind:src=" '../images/' + image " v-bind:id="title+ '_image'" alt="Hackathon Image" style="height: 100%; width: 100%; object-fit: contain">
            </div>
            <div class="card-body">
    
            <div class="chaeyoung">
                <div class="mb-3 text-white" style="background-color:#379683;border-radius:10px;text-align:center">
                <b> {{ header }} </b> </div>
                
                <h5 class="card-title"> {{ title }}</h5>
                
                <p class="card-text my-2" v-bind:id="title + '_description'" style="font-family: Arial, Helvetica, sans-serif;"> 
                    {{ description }}
                </p>
            </div>
            
            <div class="mb-3" v-if="(register_by != '-' || status != 'Coming Soon!')">
            <p class="card-text my-0"><small class="text-muted">Register by: {{ register_by }} </small></p>
            
            <p class="card-text"><small class="text-muted">Submit by: {{ submit_by }} </small></p>
            </div>
            <div class="mb-3" v-else>
            <h6 class = "text-danger">Registrations Opening in {{ start_by }}</h6>
            </div>
                <div class="row-cols-1">
                    <div class="mb-3 text-white" v-bind:id="title + '_color_exp'" title="Experience" style="background-color:#7395AE;border-radius:10px;text-align:left;text-indent: 1em">         
                        Difficulty: {{ difficulty }} 
                    </div>
                    <div class="mb-3 text-white" v-bind:id="title + '_color_type'" title="Type" style="background-color:#557A95;border-radius:10px;text-align:left;text-indent: 1em;">   
                        Type: {{ type }} 
                    </div>
                    <div class="mb-3 text-white" v-bind:id="title + '_color_team'" title="Number of Team Members" style="background-color:#B1A296;border-radius:10px;text-align:left;text-indent: 1em;">   Team: {{ team }} 
                    </div>
                </div>
            
                <button type="button" class="btn text-white" style="background-color:#7395AE"  data-bs-toggle="modal" data-bs-target="#exampleModal" v-bind:data-bs-hackathonname="title" v-bind:data-bs-link="link" :data-bs-id="id">Learn More</button>

                </div>
            </div>
        </div>
    </div> `
});

app.mount("#app");