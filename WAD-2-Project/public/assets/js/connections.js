const app = Vue.createApp({
    data() {
        return {
            toggleNavState: false,
            toggleNavStateMobile: false,
            mobileSearchIcon: "search", 
            notifications: [],
            users: [], 
            query: "", 
            connectionsPage: 2, 
            connectionsLength: 23, 
            connections: [],
            // connections: [
            //     {
            //         "id": 3,
            //         "image_name": "Ming_Rong.jpg", 
            //         "name": "Xin Yee", 
            //         "username": "xiny", 
            //         "interest": "Lorem Ipsum", 
            //         "skills": ["one", "two"], 
            //         "school": "SMU", 
            //         "year_of_study": 4, 
            //         "course": "IS", 
            //         "gender": "M"
            //     }, 
            //     {
            //         "id": 3,
            //         "image_name": "Xin_Yee.jpg", 
            //         "name": "Xin Yee", 
            //         "username": "xiny", 
            //         "interest": "Lorem Ipsum", 
            //         "skills": ["one", "two"], 
            //         "school": "SMU", 
            //         "year_of_study": 4, 
            //         "course": "IS", 
            //         "gender": "M"
            //     }, 
            //     {
            //         "id": 3,
            //         "image_name": "Xin_Yee.jpg", 
            //         "name": "Xin Yee", 
            //         "username": "xiny", 
            //         "interest": "Lorem Ipsum", 
            //         "skills": ["one", "two"], 
            //         "school": "SMU", 
            //         "year_of_study": 4, 
            //         "course": "IS", 
            //         "gender": "M"
            //     }, 
            //     {
            //         "id": 3,
            //         "image_name": "Xin_Yee.jpg", 
            //         "name": "Xin Yee", 
            //         "username": "xiny", 
            //         "interest": "Lorem Ipsum", 
            //         "skills": ["one", "two"], 
            //         "school": "SMU", 
            //         "year_of_study": 4, 
            //         "course": "IS", 
            //         "gender": "M"
            //     }, 
            //     {
            //         "id": 3,
            //         "image_name": "Ming_Rong.jpg", 
            //         "name": "Xin Yee", 
            //         "username": "xiny", 
            //         "interest": "Lorem Ipsum", 
            //         "skills": ["one", "two"], 
            //         "school": "SMU", 
            //         "year_of_study": 4, 
            //         "course": "IS", 
            //         "gender": "M"
            //     }, 
            //     {
            //         "id": 3,
            //         "image_name": "Xin_Yee.jpg", 
            //         "name": "Xin Yee", 
            //         "username": "xiny", 
            //         "interest": "Lorem Ipsum", 
            //         "skills": ["one", "two"], 
            //         "school": "SMU", 
            //         "year_of_study": 4, 
            //         "course": "IS", 
            //         "gender": "M"
            //     }, 
            // ]
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
        getGender(gender) {
            let result = null;
            switch (gender) {
                case "M":
                    result = "Male";
                    break;
                case "F":
                    result = "Female";
                    break;
                case "O":
                    result = "Others";
                    break;
            }

            return result;
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
        updateConnections(page) {
            let url = "../api/connection.php";

            axios.get(connectionURL, {
                params: {
                    query: this.query, 
                    page: page, 
                    limit: 10
                }
            })
            .then((response) => {
                this.connections = response.data.data;
                this.connectionsPage = response.data.page;
                this.connectionsLength = response.data.total;
            })
            .catch((error) => {
                console.error(error.message);
            });
        }
    }, 
    computed() {
    }, 
    created() {
        let url = '../api/user.php';
        let connectionURL = "../api/connection.php";
        
        // Use Axios
        axios.get(url)
        .then((response) => {
            this.users = response.data.data;
        })
        .catch((error) => {
            this.users = {
                entry : 'There was an error: '
            };
        });

        axios.get(connectionURL, {
            params: {
                query: this.query
            }
        })
        .then((response) => {
            this.connections = response.data.data;
            this.connectionsPage = response.data.page;
            this.connectionsLength = response.data.total;
        })
        .catch((error) => {
            console.error(error.message);
        });
    }, 
    mounted() {
        let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    }
});

app.mount("#app");