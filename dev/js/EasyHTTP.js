/**
 * EasyHTTP Library
 * Library for making HTTP Requests
 *
 * @version 3.0.0
 * @author  Brad Traversy
 * @license MIT
 * @js      ES6
 *
 **/

export default class EasyHTTP {
  constructor() {}

  //Make HTTP GET Request
  async get(url) {
    const response = await fetch(url);
    return await response.json();
  }

  //Make HTTP POST (CREATE) Request
  async post(url, args) {
    const response = await fetch(url, {
      method: "POST",
      headers: {
        "Content-type": "application/json",
      },
      body: JSON.stringify(args),
    });
    return await response.json();
  }

  //Make HTTP PUT (UPDATE) Request
  async put(url, args) {
    const response = await fetch(url, {
      method: "PUT",
      headers: {
        "Content-type": "application/json",
      },
      body: JSON.stringify(args),
    });
    return await response.json();
  }

  //Make HTTP DELETE Request
  async delete(url) {
    const response = await fetch(url, {
      method: "DELETE",
      headers: {
        "Content-type": "application/json",
      },
    });
    // const resData = "Resource Removed!";
    // return await resData;
    return await response.json();
  }

  //
  //
} //END CLASS
