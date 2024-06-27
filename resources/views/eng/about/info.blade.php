@extends('eng.layouts.eng-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">Secretariat Info</h3>
            </div>
            <div class="map-wrap">
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d940.412776599925!2d126.97315752355513!3d37.551319184945136!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca267b9ff6a33%3A0x5d5d663880bd4e17!2sCentreville%20Asterieum%20Seoul!5e0!3m2!1sen!2skr!4v1717114394130!5m2!1sen!2skr" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="map-info">
                    <ul class="list-type list-type-dot">
                        <li>
                            <strong>Address 1(Road Name Address)</strong>
                            <p>
                                1604, Block A, 372, Hangang-daero, Yongsan-gu, Seoul, Korea
                            </p>
                        </li>
                        <li>
                            <strong>Address 2(Land-Lot Based Address)</strong>
                            <p>
                                1604, Block A, Centre-vill Asterium Seoul, 372, Hangang-daero, Yongsan-gu, Seoul, Korea
                            </p>
                        </li>
                    </ul>
                    <ul class="map-info-list">
                        <li class="subway">
                            <strong>By Subway</strong>
                            <p>Exit #12, Seoul Station, Line 4</p>
                        </li>
                        <li class="car">
                            <strong>By Car</strong>
                            <p>Asterium Seoul Block A (Underground parking lot)</p>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sub-contit-wrap">
                <h4 class="sub-contit">Staffs</h4>
            </div>
            <div class="table-wrap scroll-x touch-help">
                <table class="cst-table">
                    <caption class="hide">Staffs</caption>
                    <colgroup>
                        <col style="width: 16%;">
                        <col style="width: 15%;">
                        <col>
                        <col style="width: 15%;">
                        <col style="width: 16%;">
                    </colgroup>
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Position</th>
                            <th scope="col">Division</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Phone/Fax</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">Seulgee Lee</th>
                            <td>General Manager</td>
                            <td>General Affairs, Publicity, Finance, Research</td>
                            <td><a href="mailto:khrs6@k-hrs.org" target="_blank" class="link">khrs6@k-hrs.org</a></td>
                            <td rowspan="5">
                                T. <a href="tel:+82-2-318-5416" target="_blank">+82-2-318-5416</a> <br>
                                F. +82-318-5417
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">Hyojung Kim</th>
                            <td>Manager</td>
                            <td>Symposium, International Conference</td>
                            <td><a href="mailto:khrs9@k-hrs.org" target="_blank" class="link">khrs9@k-hrs.org</a></td>
                        </tr>
                        <tr>
                            <th scope="row">Dayoung Kwon</th>
                            <td>Assistant Manager</td>
                            <td>International Conference, Finance, Research</td>
                            <td><a href="mailto:khrs2@k-hrs.org" target="_blank" class="link">khrs2@k-hrs.org</a></td>
                        </tr>
                        <tr>
                            <th scope="row">Sebin Chung</th>
                            <td rowspan="2">Team Members</td>
                            <td>Publication, Insurance, Policy, Education</td>
                            <td><a href="mailto:khrs7@k-hrs.org" target="_blank" class="link">khrs7@k-hrs.org</a></td>
                        </tr>
                        <tr>
                            <th scope="row">MinYoung Park</th>
                            <td>Research Society, Medical Information, Education, Membership, Interventional Electrophysiology Specialist Qualification</td>
                            <td><a href="mailto:khrs10@k-hrs.org" target="_blank" class="link">khrs10@k-hrs.org</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </article>
@endsection

@section('addScript')
@endsection