class Token {

    isValid(token) {
        const payload = this.payload(token);

        if (payload) {
            // E a treia parte a unui token:
            return payload.iss = "http://127.0.0.1:8000/api/auth/login" || "http://127.0.0.1:8000/api/auth/signup" ? true : false;
        }
        return false;
    }

    // Tokenul are 3 parti. Split la '.' si ii facem decrypt la token:
    payload(token) {
        const payload = token.split('.')[1];
        return this.decode(payload);
    }

    decode(payload) {
        return JSON.parse(atob(payload));
    }

}

export default Token = new Token();
