# Endpoints


## api/v1/auth/register

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/v1/auth/register" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"first":"omnis","last":"et","business_name":"nobis","country":15,"email":"charity20@example.com","password":"eum"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/auth/register"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "first": "omnis",
    "last": "et",
    "business_name": "nobis",
    "country": 15,
    "email": "charity20@example.com",
    "password": "eum"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (422):

```json
{
    "status": "failed",
    "error": [
        "The password must be at least 8 characters.",
        "The password confirmation does not match."
    ]
}
```
<div id="execution-results-POSTapi-v1-auth-register" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-auth-register"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-register"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-auth-register" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-register"></code></pre>
</div>
<form id="form-POSTapi-v1-auth-register" data-method="POST" data-path="api/v1/auth/register" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-register', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-auth-register" onclick="tryItOut('POSTapi-v1-auth-register');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-auth-register" onclick="cancelTryOut('POSTapi-v1-auth-register');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-auth-register" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/auth/register</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-auth-register" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-auth-register" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>first</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="first" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>last</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="last" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>business_name</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="business_name" data-endpoint="POSTapi-v1-auth-register" data-component="body"  hidden>
<br>
</p>
<p>
<b><code>country</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="country" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
The value must be a valid email address.</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password" data-endpoint="POSTapi-v1-auth-register" data-component="body" required  hidden>
<br>
</p>

</form>


## api/v1/auth/login

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/v1/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"erica.herzog@example.net","password":"commodi"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "erica.herzog@example.net",
    "password": "commodi"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (403):

```json
{
    "status": "unauthorized",
    "message": "Username\/Password not found."
}
```
<div id="execution-results-POSTapi-v1-auth-login" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-auth-login"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-auth-login"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-auth-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-auth-login"></code></pre>
</div>
<form id="form-POSTapi-v1-auth-login" data-method="POST" data-path="api/v1/auth/login" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-auth-login', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-auth-login" onclick="tryItOut('POSTapi-v1-auth-login');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-auth-login" onclick="cancelTryOut('POSTapi-v1-auth-login');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-auth-login" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/auth/login</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-auth-login" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-auth-login" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-auth-login" data-component="body" required  hidden>
<br>
The value must be a valid email address.</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="password" data-endpoint="POSTapi-v1-auth-login" data-component="body" required  hidden>
<br>
</p>

</form>


## api/v1/auth/user

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/v1/auth/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/auth/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (400):

```json
{
    "status": "error",
    "message": "Token invalid\/not found, please login again"
}
```
<div id="execution-results-GETapi-v1-auth-user" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-auth-user"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-auth-user"></code></pre>
</div>
<div id="execution-error-GETapi-v1-auth-user" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-auth-user"></code></pre>
</div>
<form id="form-GETapi-v1-auth-user" data-method="GET" data-path="api/v1/auth/user" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-auth-user', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-auth-user" onclick="tryItOut('GETapi-v1-auth-user');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-auth-user" onclick="cancelTryOut('GETapi-v1-auth-user');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-auth-user" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/auth/user</code></b>
</p>
<p>
<label id="auth-GETapi-v1-auth-user" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-auth-user" data-component="header"></label>
</p>
</form>


## api/v1/auth/refresh

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/v1/auth/refresh" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/auth/refresh"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (400):

```json
{
    "status": "error",
    "message": "Token invalid\/not found, please login again"
}
```
<div id="execution-results-GETapi-v1-auth-refresh" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-auth-refresh"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-auth-refresh"></code></pre>
</div>
<div id="execution-error-GETapi-v1-auth-refresh" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-auth-refresh"></code></pre>
</div>
<form id="form-GETapi-v1-auth-refresh" data-method="GET" data-path="api/v1/auth/refresh" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-auth-refresh', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-auth-refresh" onclick="tryItOut('GETapi-v1-auth-refresh');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-auth-refresh" onclick="cancelTryOut('GETapi-v1-auth-refresh');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-auth-refresh" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/auth/refresh</code></b>
</p>
<p>
<label id="auth-GETapi-v1-auth-refresh" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-auth-refresh" data-component="header"></label>
</p>
</form>


## api/v1/auth/logout

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/v1/auth/logout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/auth/logout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (400):

```json
{
    "status": "error",
    "message": "Token invalid\/not found, please login again"
}
```
<div id="execution-results-GETapi-v1-auth-logout" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-auth-logout"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-auth-logout"></code></pre>
</div>
<div id="execution-error-GETapi-v1-auth-logout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-auth-logout"></code></pre>
</div>
<form id="form-GETapi-v1-auth-logout" data-method="GET" data-path="api/v1/auth/logout" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-auth-logout', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-auth-logout" onclick="tryItOut('GETapi-v1-auth-logout');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-auth-logout" onclick="cancelTryOut('GETapi-v1-auth-logout');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-auth-logout" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/auth/logout</code></b>
</p>
<p>
<label id="auth-GETapi-v1-auth-logout" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-auth-logout" data-component="header"></label>
</p>
</form>


## api/v1/country/list

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/v1/country/list" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/country/list"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (200):

```json
[
    {
        "id": 1,
        "name": "Afghanistan"
    },
    {
        "id": 2,
        "name": "Åland Islands"
    },
    {
        "id": 3,
        "name": "Albania"
    },
    {
        "id": 4,
        "name": "Algeria"
    },
    {
        "id": 5,
        "name": "American Samoa"
    },
    {
        "id": 6,
        "name": "Andorra"
    },
    {
        "id": 7,
        "name": "Angola"
    },
    {
        "id": 8,
        "name": "Anguilla"
    },
    {
        "id": 9,
        "name": "Antarctica"
    },
    {
        "id": 10,
        "name": "Antigua and Barbuda"
    },
    {
        "id": 11,
        "name": "Argentina"
    },
    {
        "id": 12,
        "name": "Armenia"
    },
    {
        "id": 13,
        "name": "Aruba"
    },
    {
        "id": 14,
        "name": "Australia"
    },
    {
        "id": 15,
        "name": "Austria"
    },
    {
        "id": 16,
        "name": "Azerbaijan"
    },
    {
        "id": 17,
        "name": "Bahamas"
    },
    {
        "id": 18,
        "name": "Bahrain"
    },
    {
        "id": 19,
        "name": "Bangladesh"
    },
    {
        "id": 20,
        "name": "Barbados"
    },
    {
        "id": 21,
        "name": "Belarus"
    },
    {
        "id": 22,
        "name": "Belgium"
    },
    {
        "id": 23,
        "name": "Belize"
    },
    {
        "id": 24,
        "name": "Benin"
    },
    {
        "id": 25,
        "name": "Bermuda"
    },
    {
        "id": 26,
        "name": "Bhutan"
    },
    {
        "id": 27,
        "name": "Bolivia, Plurinational State of"
    },
    {
        "id": 28,
        "name": "Bonaire, Sint Eustatius and Saba"
    },
    {
        "id": 29,
        "name": "Bosnia and Herzegovina"
    },
    {
        "id": 30,
        "name": "Botswana"
    },
    {
        "id": 31,
        "name": "Bouvet Island"
    },
    {
        "id": 32,
        "name": "Brazil"
    },
    {
        "id": 33,
        "name": "British Indian Ocean Territory"
    },
    {
        "id": 34,
        "name": "Brunei Darussalam"
    },
    {
        "id": 35,
        "name": "Bulgaria"
    },
    {
        "id": 36,
        "name": "Burkina Faso"
    },
    {
        "id": 37,
        "name": "Burundi"
    },
    {
        "id": 38,
        "name": "Cambodia"
    },
    {
        "id": 39,
        "name": "Cameroon"
    },
    {
        "id": 40,
        "name": "Canada"
    },
    {
        "id": 41,
        "name": "Cape Verde"
    },
    {
        "id": 42,
        "name": "Cayman Islands"
    },
    {
        "id": 43,
        "name": "Central African Republic"
    },
    {
        "id": 44,
        "name": "Chad"
    },
    {
        "id": 45,
        "name": "Chile"
    },
    {
        "id": 46,
        "name": "China"
    },
    {
        "id": 47,
        "name": "Christmas Island"
    },
    {
        "id": 48,
        "name": "Cocos (Keeling) Islands"
    },
    {
        "id": 49,
        "name": "Colombia"
    },
    {
        "id": 50,
        "name": "Comoros"
    },
    {
        "id": 51,
        "name": "Congo"
    },
    {
        "id": 52,
        "name": "Congo, the Democratic Republic of the"
    },
    {
        "id": 53,
        "name": "Cook Islands"
    },
    {
        "id": 54,
        "name": "Costa Rica"
    },
    {
        "id": 55,
        "name": "Côte d'Ivoire"
    },
    {
        "id": 56,
        "name": "Croatia"
    },
    {
        "id": 57,
        "name": "Cuba"
    },
    {
        "id": 58,
        "name": "Curaçao"
    },
    {
        "id": 59,
        "name": "Cyprus"
    },
    {
        "id": 60,
        "name": "Czech Republic"
    },
    {
        "id": 61,
        "name": "Denmark"
    },
    {
        "id": 62,
        "name": "Djibouti"
    },
    {
        "id": 63,
        "name": "Dominica"
    },
    {
        "id": 64,
        "name": "Dominican Republic"
    },
    {
        "id": 65,
        "name": "Ecuador"
    },
    {
        "id": 66,
        "name": "Egypt"
    },
    {
        "id": 67,
        "name": "El Salvador"
    },
    {
        "id": 68,
        "name": "Equatorial Guinea"
    },
    {
        "id": 69,
        "name": "Eritrea"
    },
    {
        "id": 70,
        "name": "Estonia"
    },
    {
        "id": 71,
        "name": "Ethiopia"
    },
    {
        "id": 72,
        "name": "Falkland Islands (Malvinas)"
    },
    {
        "id": 73,
        "name": "Faroe Islands"
    },
    {
        "id": 74,
        "name": "Fiji"
    },
    {
        "id": 75,
        "name": "Finland"
    },
    {
        "id": 76,
        "name": "France"
    },
    {
        "id": 77,
        "name": "French Guiana"
    },
    {
        "id": 78,
        "name": "French Polynesia"
    },
    {
        "id": 79,
        "name": "French Southern Territories"
    },
    {
        "id": 80,
        "name": "Gabon"
    },
    {
        "id": 81,
        "name": "Gambia"
    },
    {
        "id": 82,
        "name": "Georgia"
    },
    {
        "id": 83,
        "name": "Germany"
    },
    {
        "id": 84,
        "name": "Ghana"
    },
    {
        "id": 85,
        "name": "Gibraltar"
    },
    {
        "id": 86,
        "name": "Greece"
    },
    {
        "id": 87,
        "name": "Greenland"
    },
    {
        "id": 88,
        "name": "Grenada"
    },
    {
        "id": 89,
        "name": "Guadeloupe"
    },
    {
        "id": 90,
        "name": "Guam"
    },
    {
        "id": 91,
        "name": "Guatemala"
    },
    {
        "id": 92,
        "name": "Guernsey"
    },
    {
        "id": 93,
        "name": "Guinea"
    },
    {
        "id": 94,
        "name": "Guinea-Bissau"
    },
    {
        "id": 95,
        "name": "Guyana"
    },
    {
        "id": 96,
        "name": "Haiti"
    },
    {
        "id": 97,
        "name": "Heard Island and McDonald Mcdonald Islands"
    },
    {
        "id": 98,
        "name": "Holy See (Vatican City State)"
    },
    {
        "id": 99,
        "name": "Honduras"
    },
    {
        "id": 100,
        "name": "Hong Kong"
    },
    {
        "id": 101,
        "name": "Hungary"
    },
    {
        "id": 102,
        "name": "Iceland"
    },
    {
        "id": 103,
        "name": "India"
    },
    {
        "id": 104,
        "name": "Indonesia"
    },
    {
        "id": 105,
        "name": "Iran, Islamic Republic of"
    },
    {
        "id": 106,
        "name": "Iraq"
    },
    {
        "id": 107,
        "name": "Ireland"
    },
    {
        "id": 108,
        "name": "Isle of Man"
    },
    {
        "id": 109,
        "name": "Israel"
    },
    {
        "id": 110,
        "name": "Italy"
    },
    {
        "id": 111,
        "name": "Jamaica"
    },
    {
        "id": 112,
        "name": "Japan"
    },
    {
        "id": 113,
        "name": "Jersey"
    },
    {
        "id": 114,
        "name": "Jordan"
    },
    {
        "id": 115,
        "name": "Kazakhstan"
    },
    {
        "id": 116,
        "name": "Kenya"
    },
    {
        "id": 117,
        "name": "Kiribati"
    },
    {
        "id": 118,
        "name": "Korea, Democratic People's Republic of"
    },
    {
        "id": 119,
        "name": "Korea, Republic of"
    },
    {
        "id": 120,
        "name": "Kuwait"
    },
    {
        "id": 121,
        "name": "Kyrgyzstan"
    },
    {
        "id": 122,
        "name": "Lao People's Democratic Republic"
    },
    {
        "id": 123,
        "name": "Latvia"
    },
    {
        "id": 124,
        "name": "Lebanon"
    },
    {
        "id": 125,
        "name": "Lesotho"
    },
    {
        "id": 126,
        "name": "Liberia"
    },
    {
        "id": 127,
        "name": "Libya"
    },
    {
        "id": 128,
        "name": "Liechtenstein"
    },
    {
        "id": 129,
        "name": "Lithuania"
    },
    {
        "id": 130,
        "name": "Luxembourg"
    },
    {
        "id": 131,
        "name": "Macao"
    },
    {
        "id": 132,
        "name": "Macedonia, the Former Yugoslav Republic of"
    },
    {
        "id": 133,
        "name": "Madagascar"
    },
    {
        "id": 134,
        "name": "Malawi"
    },
    {
        "id": 135,
        "name": "Malaysia"
    },
    {
        "id": 136,
        "name": "Maldives"
    },
    {
        "id": 137,
        "name": "Mali"
    },
    {
        "id": 138,
        "name": "Malta"
    },
    {
        "id": 139,
        "name": "Marshall Islands"
    },
    {
        "id": 140,
        "name": "Martinique"
    },
    {
        "id": 141,
        "name": "Mauritania"
    },
    {
        "id": 142,
        "name": "Mauritius"
    },
    {
        "id": 143,
        "name": "Mayotte"
    },
    {
        "id": 144,
        "name": "Mexico"
    },
    {
        "id": 145,
        "name": "Micronesia, Federated States of"
    },
    {
        "id": 146,
        "name": "Moldova, Republic of"
    },
    {
        "id": 147,
        "name": "Monaco"
    },
    {
        "id": 148,
        "name": "Mongolia"
    },
    {
        "id": 149,
        "name": "Montenegro"
    },
    {
        "id": 150,
        "name": "Montserrat"
    },
    {
        "id": 151,
        "name": "Morocco"
    },
    {
        "id": 152,
        "name": "Mozambique"
    },
    {
        "id": 153,
        "name": "Myanmar"
    },
    {
        "id": 154,
        "name": "Namibia"
    },
    {
        "id": 155,
        "name": "Nauru"
    },
    {
        "id": 156,
        "name": "Nepal"
    },
    {
        "id": 157,
        "name": "Netherlands"
    },
    {
        "id": 158,
        "name": "New Caledonia"
    },
    {
        "id": 159,
        "name": "New Zealand"
    },
    {
        "id": 160,
        "name": "Nicaragua"
    },
    {
        "id": 161,
        "name": "Niger"
    },
    {
        "id": 162,
        "name": "Nigeria"
    },
    {
        "id": 163,
        "name": "Niue"
    },
    {
        "id": 164,
        "name": "Norfolk Island"
    },
    {
        "id": 165,
        "name": "Northern Mariana Islands"
    },
    {
        "id": 166,
        "name": "Norway"
    },
    {
        "id": 167,
        "name": "Oman"
    },
    {
        "id": 168,
        "name": "Pakistan"
    },
    {
        "id": 169,
        "name": "Palau"
    },
    {
        "id": 170,
        "name": "Palestine, State of"
    },
    {
        "id": 171,
        "name": "Panama"
    },
    {
        "id": 172,
        "name": "Papua New Guinea"
    },
    {
        "id": 173,
        "name": "Paraguay"
    },
    {
        "id": 174,
        "name": "Peru"
    },
    {
        "id": 175,
        "name": "Philippines"
    },
    {
        "id": 176,
        "name": "Pitcairn"
    },
    {
        "id": 177,
        "name": "Poland"
    },
    {
        "id": 178,
        "name": "Portugal"
    },
    {
        "id": 179,
        "name": "Puerto Rico"
    },
    {
        "id": 180,
        "name": "Qatar"
    },
    {
        "id": 181,
        "name": "Réunion"
    },
    {
        "id": 182,
        "name": "Romania"
    },
    {
        "id": 183,
        "name": "Russian Federation"
    },
    {
        "id": 184,
        "name": "Rwanda"
    },
    {
        "id": 185,
        "name": "Saint Barthélemy"
    },
    {
        "id": 186,
        "name": "Saint Helena, Ascension and Tristan da Cunha"
    },
    {
        "id": 187,
        "name": "Saint Kitts and Nevis"
    },
    {
        "id": 188,
        "name": "Saint Lucia"
    },
    {
        "id": 189,
        "name": "Saint Martin (French part)"
    },
    {
        "id": 190,
        "name": "Saint Pierre and Miquelon"
    },
    {
        "id": 191,
        "name": "Saint Vincent and the Grenadines"
    },
    {
        "id": 192,
        "name": "Samoa"
    },
    {
        "id": 193,
        "name": "San Marino"
    },
    {
        "id": 194,
        "name": "Sao Tome and Principe"
    },
    {
        "id": 195,
        "name": "Saudi Arabia"
    },
    {
        "id": 196,
        "name": "Senegal"
    },
    {
        "id": 197,
        "name": "Serbia"
    },
    {
        "id": 198,
        "name": "Seychelles"
    },
    {
        "id": 199,
        "name": "Sierra Leone"
    },
    {
        "id": 200,
        "name": "Singapore"
    },
    {
        "id": 201,
        "name": "Sint Maarten (Dutch part)"
    },
    {
        "id": 202,
        "name": "Slovakia"
    },
    {
        "id": 203,
        "name": "Slovenia"
    },
    {
        "id": 204,
        "name": "Solomon Islands"
    },
    {
        "id": 205,
        "name": "Somalia"
    },
    {
        "id": 206,
        "name": "South Africa"
    },
    {
        "id": 207,
        "name": "South Georgia and the South Sandwich Islands"
    },
    {
        "id": 208,
        "name": "South Sudan"
    },
    {
        "id": 209,
        "name": "Spain"
    },
    {
        "id": 210,
        "name": "Sri Lanka"
    },
    {
        "id": 211,
        "name": "Sudan"
    },
    {
        "id": 212,
        "name": "Suriname"
    },
    {
        "id": 213,
        "name": "Svalbard and Jan Mayen"
    },
    {
        "id": 214,
        "name": "Swaziland"
    },
    {
        "id": 215,
        "name": "Sweden"
    },
    {
        "id": 216,
        "name": "Switzerland"
    },
    {
        "id": 217,
        "name": "Syrian Arab Republic"
    },
    {
        "id": 218,
        "name": "Taiwan"
    },
    {
        "id": 219,
        "name": "Tajikistan"
    },
    {
        "id": 220,
        "name": "Tanzania, United Republic of"
    },
    {
        "id": 221,
        "name": "Thailand"
    },
    {
        "id": 222,
        "name": "Timor-Leste"
    },
    {
        "id": 223,
        "name": "Togo"
    },
    {
        "id": 224,
        "name": "Tokelau"
    },
    {
        "id": 225,
        "name": "Tonga"
    },
    {
        "id": 226,
        "name": "Trinidad and Tobago"
    },
    {
        "id": 227,
        "name": "Tunisia"
    },
    {
        "id": 228,
        "name": "Turkey"
    },
    {
        "id": 229,
        "name": "Turkmenistan"
    },
    {
        "id": 230,
        "name": "Turks and Caicos Islands"
    },
    {
        "id": 231,
        "name": "Tuvalu"
    },
    {
        "id": 232,
        "name": "Uganda"
    },
    {
        "id": 233,
        "name": "Ukraine"
    },
    {
        "id": 234,
        "name": "United Arab Emirates"
    },
    {
        "id": 235,
        "name": "United Kingdom"
    },
    {
        "id": 236,
        "name": "United States"
    },
    {
        "id": 237,
        "name": "United States Minor Outlying Islands"
    },
    {
        "id": 238,
        "name": "Uruguay"
    },
    {
        "id": 239,
        "name": "Uzbekistan"
    },
    {
        "id": 240,
        "name": "Vanuatu"
    },
    {
        "id": 241,
        "name": "Venezuela, Bolivarian Republic of"
    },
    {
        "id": 242,
        "name": "Viet Nam"
    },
    {
        "id": 243,
        "name": "Virgin Islands, British"
    },
    {
        "id": 244,
        "name": "Virgin Islands, U.S."
    },
    {
        "id": 245,
        "name": "Wallis and Futuna"
    },
    {
        "id": 246,
        "name": "Western Sahara"
    },
    {
        "id": 247,
        "name": "Yemen"
    },
    {
        "id": 248,
        "name": "Zambia"
    },
    {
        "id": 249,
        "name": "Zimbabwe"
    }
]
```
<div id="execution-results-GETapi-v1-country-list" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-country-list"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-country-list"></code></pre>
</div>
<div id="execution-error-GETapi-v1-country-list" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-country-list"></code></pre>
</div>
<form id="form-GETapi-v1-country-list" data-method="GET" data-path="api/v1/country/list" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-country-list', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-country-list" onclick="tryItOut('GETapi-v1-country-list');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-country-list" onclick="cancelTryOut('GETapi-v1-country-list');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-country-list" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/country/list</code></b>
</p>
<p>
<label id="auth-GETapi-v1-country-list" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-country-list" data-component="header"></label>
</p>
</form>


## api/v1/wallet

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/v1/wallet" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/wallet"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (400):

```json
{
    "status": "error",
    "message": "Token invalid\/not found, please login again"
}
```
<div id="execution-results-GETapi-v1-wallet" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-wallet"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-wallet"></code></pre>
</div>
<div id="execution-error-GETapi-v1-wallet" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-wallet"></code></pre>
</div>
<form id="form-GETapi-v1-wallet" data-method="GET" data-path="api/v1/wallet" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-wallet', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-wallet" onclick="tryItOut('GETapi-v1-wallet');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-wallet" onclick="cancelTryOut('GETapi-v1-wallet');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-wallet" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/wallet</code></b>
</p>
<p>
<label id="auth-GETapi-v1-wallet" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-wallet" data-component="header"></label>
</p>
</form>


## store

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/v1/wallet" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"label":"vero","type":50.283553}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/wallet"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "label": "vero",
    "type": 50.283553
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


> Example response (400):

```json
{
    "status": "error",
    "message": "Token invalid\/not found, please login again"
}
```
<div id="execution-results-POSTapi-v1-wallet" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-wallet"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-wallet"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-wallet" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-wallet"></code></pre>
</div>
<form id="form-POSTapi-v1-wallet" data-method="POST" data-path="api/v1/wallet" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-wallet', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-wallet" onclick="tryItOut('POSTapi-v1-wallet');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-wallet" onclick="cancelTryOut('POSTapi-v1-wallet');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-wallet" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/wallet</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-wallet" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-wallet" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>label</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="label" data-endpoint="POSTapi-v1-wallet" data-component="body" required  hidden>
<br>
</p>
<p>
<b><code>type</code></b>&nbsp;&nbsp;<small>number</small>  &nbsp;
<input type="number" name="type" data-endpoint="POSTapi-v1-wallet" data-component="body" required  hidden>
<br>
</p>

</form>


## balance

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/v1/wallet/perferendis/balance" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/wallet/perferendis/balance"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (404):

```json
{
    "message": "No query results for model [App\\Models\\Wallet] perferendis",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException",
    "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Exceptions\/Handler.php",
    "line": 368,
    "trace": [
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Exceptions\/Handler.php",
            "line": 317,
            "function": "prepareException",
            "class": "Illuminate\\Foundation\\Exceptions\\Handler",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/nunomaduro\/collision\/src\/Adapters\/Laravel\/ExceptionHandler.php",
            "line": 54,
            "function": "render",
            "class": "Illuminate\\Foundation\\Exceptions\\Handler",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 51,
            "function": "render",
            "class": "NunoMaduro\\Collision\\Adapters\\Laravel\\ExceptionHandler",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 172,
            "function": "handleException",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 127,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 103,
            "function": "handleRequest",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 55,
            "function": "handleRequestUsingNamedLimiter",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 103,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 695,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 670,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 625,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 166,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 128,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Cookie\/Middleware\/AddQueuedCookiesToResponse.php",
            "line": 37,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 21,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 21,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/PreventRequestsDuringMaintenance.php",
            "line": 86,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/fruitcake\/laravel-cors\/src\/HandleCors.php",
            "line": 57,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Fruitcake\\Cors\\HandleCors",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 103,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 141,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 110,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 324,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 305,
            "function": "callLaravelOrLumenRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 76,
            "function": "makeApiCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 51,
            "function": "makeResponseCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 41,
            "function": "makeResponseCallIfEnabledAndNoSuccessResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 236,
            "function": "__invoke",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 172,
            "function": "iterateThroughStrategies",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 127,
            "function": "fetchResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Commands\/GenerateDocumentation.php",
            "line": 119,
            "function": "processRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Commands\/GenerateDocumentation.php",
            "line": 73,
            "function": "processRoutes",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 36,
            "function": "handle",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Util.php",
            "line": 40,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 93,
            "function": "unwrapIfClosure",
            "class": "Illuminate\\Container\\Util",
            "type": "::"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 37,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 610,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 136,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 256,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 121,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/symfony\/console\/Application.php",
            "line": 971,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/symfony\/console\/Application.php",
            "line": 290,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/symfony\/console\/Application.php",
            "line": 166,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 93,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 129,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```
<div id="execution-results-GETapi-v1-wallet--wallet--balance" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-wallet--wallet--balance"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-wallet--wallet--balance"></code></pre>
</div>
<div id="execution-error-GETapi-v1-wallet--wallet--balance" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-wallet--wallet--balance"></code></pre>
</div>
<form id="form-GETapi-v1-wallet--wallet--balance" data-method="GET" data-path="api/v1/wallet/{wallet}/balance" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-wallet--wallet--balance', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-wallet--wallet--balance" onclick="tryItOut('GETapi-v1-wallet--wallet--balance');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-wallet--wallet--balance" onclick="cancelTryOut('GETapi-v1-wallet--wallet--balance');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-wallet--wallet--balance" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/wallet/{wallet}/balance</code></b>
</p>
<p>
<label id="auth-GETapi-v1-wallet--wallet--balance" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-wallet--wallet--balance" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>wallet</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="wallet" data-endpoint="GETapi-v1-wallet--wallet--balance" data-component="url" required  hidden>
<br>
</p>
</form>


## address

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/v1/wallet/eum/address" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/wallet/eum/address"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (404):

```json
{
    "message": "No query results for model [App\\Models\\Wallet] eum",
    "exception": "Symfony\\Component\\HttpKernel\\Exception\\NotFoundHttpException",
    "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Exceptions\/Handler.php",
    "line": 368,
    "trace": [
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Exceptions\/Handler.php",
            "line": 317,
            "function": "prepareException",
            "class": "Illuminate\\Foundation\\Exceptions\\Handler",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/nunomaduro\/collision\/src\/Adapters\/Laravel\/ExceptionHandler.php",
            "line": 54,
            "function": "render",
            "class": "Illuminate\\Foundation\\Exceptions\\Handler",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Pipeline.php",
            "line": 51,
            "function": "render",
            "class": "NunoMaduro\\Collision\\Adapters\\Laravel\\ExceptionHandler",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 172,
            "function": "handleException",
            "class": "Illuminate\\Routing\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 127,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 103,
            "function": "handleRequest",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Middleware\/ThrottleRequests.php",
            "line": 55,
            "function": "handleRequestUsingNamedLimiter",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Routing\\Middleware\\ThrottleRequests",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 103,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 695,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 670,
            "function": "runRouteWithinStack",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 636,
            "function": "runRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Routing\/Router.php",
            "line": 625,
            "function": "dispatchToRoute",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 166,
            "function": "dispatch",
            "class": "Illuminate\\Routing\\Router",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 128,
            "function": "Illuminate\\Foundation\\Http\\{closure}",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Cookie\/Middleware\/AddQueuedCookiesToResponse.php",
            "line": 37,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Cookie\\Middleware\\AddQueuedCookiesToResponse",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 21,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/TransformsRequest.php",
            "line": 21,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\TransformsRequest",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/ValidatePostSize.php",
            "line": 27,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\ValidatePostSize",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Middleware\/PreventRequestsDuringMaintenance.php",
            "line": 86,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Middleware\\PreventRequestsDuringMaintenance",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/fruitcake\/laravel-cors\/src\/HandleCors.php",
            "line": 57,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Fruitcake\\Cors\\HandleCors",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/fideloper\/proxy\/src\/TrustProxies.php",
            "line": 57,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 167,
            "function": "handle",
            "class": "Fideloper\\Proxy\\TrustProxies",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Pipeline\/Pipeline.php",
            "line": 103,
            "function": "Illuminate\\Pipeline\\{closure}",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 141,
            "function": "then",
            "class": "Illuminate\\Pipeline\\Pipeline",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Http\/Kernel.php",
            "line": 110,
            "function": "sendRequestThroughRouter",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 324,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Http\\Kernel",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 305,
            "function": "callLaravelOrLumenRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 76,
            "function": "makeApiCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 51,
            "function": "makeResponseCall",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Strategies\/Responses\/ResponseCalls.php",
            "line": 41,
            "function": "makeResponseCallIfEnabledAndNoSuccessResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 236,
            "function": "__invoke",
            "class": "Knuckles\\Scribe\\Extracting\\Strategies\\Responses\\ResponseCalls",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 172,
            "function": "iterateThroughStrategies",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Extracting\/Generator.php",
            "line": 127,
            "function": "fetchResponses",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Commands\/GenerateDocumentation.php",
            "line": 119,
            "function": "processRoute",
            "class": "Knuckles\\Scribe\\Extracting\\Generator",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/knuckleswtf\/scribe\/src\/Commands\/GenerateDocumentation.php",
            "line": 73,
            "function": "processRoutes",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 36,
            "function": "handle",
            "class": "Knuckles\\Scribe\\Commands\\GenerateDocumentation",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Util.php",
            "line": 40,
            "function": "Illuminate\\Container\\{closure}",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 93,
            "function": "unwrapIfClosure",
            "class": "Illuminate\\Container\\Util",
            "type": "::"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/BoundMethod.php",
            "line": 37,
            "function": "callBoundMethod",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Container\/Container.php",
            "line": 610,
            "function": "call",
            "class": "Illuminate\\Container\\BoundMethod",
            "type": "::"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 136,
            "function": "call",
            "class": "Illuminate\\Container\\Container",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/symfony\/console\/Command\/Command.php",
            "line": 256,
            "function": "execute",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Command.php",
            "line": 121,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Command\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/symfony\/console\/Application.php",
            "line": 971,
            "function": "run",
            "class": "Illuminate\\Console\\Command",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/symfony\/console\/Application.php",
            "line": 290,
            "function": "doRunCommand",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/symfony\/console\/Application.php",
            "line": 166,
            "function": "doRun",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Console\/Application.php",
            "line": 93,
            "function": "run",
            "class": "Symfony\\Component\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/vendor\/laravel\/framework\/src\/Illuminate\/Foundation\/Console\/Kernel.php",
            "line": 129,
            "function": "run",
            "class": "Illuminate\\Console\\Application",
            "type": "->"
        },
        {
            "file": "\/Users\/musti\/coinphon\/artisan",
            "line": 37,
            "function": "handle",
            "class": "Illuminate\\Foundation\\Console\\Kernel",
            "type": "->"
        }
    ]
}
```
<div id="execution-results-GETapi-v1-wallet--wallet--address" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-wallet--wallet--address"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-wallet--wallet--address"></code></pre>
</div>
<div id="execution-error-GETapi-v1-wallet--wallet--address" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-wallet--wallet--address"></code></pre>
</div>
<form id="form-GETapi-v1-wallet--wallet--address" data-method="GET" data-path="api/v1/wallet/{wallet}/address" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-wallet--wallet--address', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-wallet--wallet--address" onclick="tryItOut('GETapi-v1-wallet--wallet--address');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-wallet--wallet--address" onclick="cancelTryOut('GETapi-v1-wallet--wallet--address');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-wallet--wallet--address" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/wallet/{wallet}/address</code></b>
</p>
<p>
<label id="auth-GETapi-v1-wallet--wallet--address" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-wallet--wallet--address" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>wallet</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="wallet" data-endpoint="GETapi-v1-wallet--wallet--address" data-component="url" required  hidden>
<br>
</p>
</form>


## index

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/v1/order" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/order"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (400):

```json
{
    "status": "error",
    "message": "Token invalid\/not found, please login again"
}
```
<div id="execution-results-GETapi-v1-order" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-order"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-order"></code></pre>
</div>
<div id="execution-error-GETapi-v1-order" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-order"></code></pre>
</div>
<form id="form-GETapi-v1-order" data-method="GET" data-path="api/v1/order" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-order', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-order" onclick="tryItOut('GETapi-v1-order');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-order" onclick="cancelTryOut('GETapi-v1-order');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-order" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/order</code></b>
</p>
<p>
<label id="auth-GETapi-v1-order" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-order" data-component="header"></label>
</p>
</form>



