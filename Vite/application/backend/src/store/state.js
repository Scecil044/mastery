
const state = {
    user: {
        token: sessionStorage.getItem("TOKEN"),
        data: {}
    },
    products: {
        loading: false,
        data: [],
        to: null,
        from: null,
        page: 1,
        links: [],
        limit: null,
        total: null
    }
}


export default state
