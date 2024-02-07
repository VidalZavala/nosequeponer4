import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { RespuestaTopHeadlines } from '../interfaces/interfaces';

@Injectable({
  providedIn: 'root'
})
export class NoticiasService {

  constructor( private http:HttpClient) { }

getTopHeadlines(){
 return this.http.get<RespuestaTopHeadlines>(` http://newsapi.org/v2/everything?q=tesla&from=2021-02-12&sortBy=publishedAt&apiKey=8a8ed01ff25847dfa69330a3c89a0d00`);
}

}
