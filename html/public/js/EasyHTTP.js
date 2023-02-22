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
export default class EasyHTTP{constructor(){}async get(t){const a=await fetch(t);return await a.json()}async post(t,a){const n=await fetch(t,{method:"POST",headers:{"Content-type":"application/json"},body:JSON.stringify(a)});return await n.json()}async put(t,a){const n=await fetch(t,{method:"PUT",headers:{"Content-type":"application/json"},body:JSON.stringify(a)});return await n.json()}async delete(t){const a=await fetch(t,{method:"DELETE",headers:{"Content-type":"application/json"}});return await a.json()}}