const app = Vue.createApp({
    data() {
        return {
            toggleNavState: false,
            toggleNavStateMobile: false,
            mobileSearchIcon: "search",
            notifications: [], // API
            user: null,
            portfolio: [], // API
            news: [
                // {
                //     title: "one",
                //     summary: "lorem ipsum",
                //     published_date: "date time",
                //     link: "https://www.google.com"
                // },
                // {
                //     title: "two",
                //     summary: "lorem ipsum",
                //     published_date: "date time",
                //     link: "https://www.google.com"
                // },
                // {
                //     title: "three",
                //     summary: "lorem ipsum",
                //     published_date: "date time",
                //     link: "https://www.google.com"
                // }
            ], // API
            competitions: [
                {
                    name: "First",
                    image_name: "A",
                    date_start: "2021-10-19"
                },
                {
                    name: "Second",
                    image_name: "B",
                    date_start: "2021-10-19"
                },
                {
                    name: "Third",
                    image_name: "C",
                    date_start: "2021-10-19"
                }
            ], // API
            matches: [
                {
                    name: "First",
                    image_name: "Xin_Yee.jpg",
                    skills: ["a", "b", "c"]
                },
                {
                    name: "Second",
                    image_name: "Xin_Yee.jpg",
                    skills: ["a", "b", "c"]
                },
                {
                    name: "Third",
                    image_name: "Xin_Yee.jpg",
                    skills: ["a", "b", "c"]
                }
            ], // API
            chats: [
                {
                    name: "Xinyee",
                    image_name: "Xin_Yee.jpg",
                    message: "Hi!"
                },
                {
                    name: "Second",
                    image_name: "Ming_Rong.jpg",
                    message: "Sure!!"
                },
                // {
                //     name: "Third",
                //     image_name: "Ming_Rong.jpg",
                //     message: "Lorem Ipsum"
                // }
            ] // API
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
        }
    },
    computed() {
    },
    created() {
        let userURL = "./api/user.php";
        let competitionURL = "./api/competition.php";
        let matchURL = "./api/retrieveMatches.php";
        let chatURL = "./api/newChats.php";
        let makeMatchURL = "./api/generateMatches.php";

        axios.get(userURL, {
            params: {}
        })
        .then((res) => {
            this.user = res.data.data;
        })
        .catch((err) => {
            console.error(err.message);
        });

        axios.get(competitionURL, {
            params: {}
        })
        .then((res) => {
            this.competitions = res.data.data;
        })
        .catch((err) => {
            console.error(err.message);
        });

        axios.post(makeMatchURL)
        .then((res) => {
            console.log(res.data.status);

            axios.get(matchURL, {
                params: {}
            })
            .then((res) => {
                this.matches = res.data.data;
            })
            .catch((err) => {
                console.error(err.message);
            });
        })
        .catch((err) => {
            console.error(err.message);

            axios.get(matchURL, {
                params: {}
            })
            .then((res) => {
                this.matches = res.data.data;
            })
            .catch((err) => {
                console.error(err.message);
            });
        });

        // axios.get(chatURL, {
        //     params: {}
        // })
        // .then((res) => {
        //     this.chats = res.data.data;
        // })
        // .catch((err) => {
        //     console.error(err.message);
        // });
    },
    mounted() {
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    }
});

app.mount("#app");
