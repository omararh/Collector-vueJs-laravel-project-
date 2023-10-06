export default function() {

    function getDomain() {
        return `${process.env.VUE_APP_BASE_URL}`;
    }

    function getBaseUrlApi() {
        return `${getDomain()}/api`
    }

    return {
        getDomain,
        getBaseUrlApi
    }
}