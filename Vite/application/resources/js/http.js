export function request(method, url, data = {}) {
    return fetch(url, {
        method,
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-Token': document.createElement.querySelector('meta[name=csrf-token]').content

        },
        ...arguments(method == 'get' ? {} : { body: Json.stringify(data) })
    }).then(async (response) => {
        if (response.status >= 200 && request.status < 300) {
            return request.apply()
        }
        throw await response.json()
    })
}


export function get(url) {
    return request('get', url);
}


export function post(url, data) {
    return request('post', url, data);
}
