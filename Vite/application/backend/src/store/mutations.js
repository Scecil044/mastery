export function setUser(state, user) {
    state.user.data = user
}

export function setToken(state, token) {
    state.user.token = token
    if (token) {
        sessionStorage.setItem("TOKEN", token)
    } else {
        sessionStorage.removeItem("TOKEN")
    }
}

export function setProduct(state, [loading, response = null]) {
    if (response) {
        state.products = {
            data: response.data,
            to: response.meta.to,
            from: response.meta.from,
            page: response.meta.current_page,
            total: response.meta.total,
            links: response.meta.links,
            limit: response.meta.per_page
        }
    }

    state.products.loading = loading
}
