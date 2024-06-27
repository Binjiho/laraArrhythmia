@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            @include('layouts.include.subTit')
            
            <div class="sub-tab-wrap">
                <ul class="sub-tab-menu n3 cf js-tabcon-menu">
                    <li class="on"><a href="#n">생명 윤리</a></li>
                    <li><a href="#n">연구 윤리</a></li>
                    <li><a href="#n">연구 출판 윤리</a></li>
                </ul>
            </div>
            <div class="sub-tab-con js-tab-con" style="display: block;">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">생명 윤리</h4>
                </div>
                <div class="rules-conbox">
                    <ul class="list-type list-type-dot">
                        <li>
                            “의사소통, 대인 접촉 등의 상호작용을 통하여 수행하는 연구”를 연구대상자의 행동관찰, 대면(對面) 설문조사 등으로 자료를 얻는 연구로 정의한다.
                        </li>
                        <li>
                            IRB 심의를 면제할 수 있는 연구일반 대중에게 공개된 정보를 이용하는 연구 또는 개인식별정보를 수집•기록 하지 않는 연구로서 연구대상자를 직접 대면하더라도 연구대상자가 특정되지 않고 “개인정보보호법”에 따른 민감정보를 수집하거나 기록하지 않는 연구.
                        </li>
                        <li>
                            생명윤리법은 위의 IRB 심의면제조항에도 불구하고 “약사법 시행규칙”의 취약한 환경에 있는 피험자(vulnerable subjects)를 대상으로 하는 연구는 IRB의 심의를 받도록 하고 있다.
                        </li>
                    </ul>
                </div>

                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">개인정보 이용 연구</h4>
                </div>
                <div class="rules-conbox">
                    <ul class="list-type list-type-text">
                        <li>
                            <span>(1)</span>
                            <div>
                                일반 대중에게 공개된 정보를 이용하는 연구 또는 개인식별 정보를 수집•기록하지 않는 연구
                            </div>
                        </li>
                        <li>
                            <span>(2)</span>
                            <div>
                                연구대상자 등에 대한 기존 자료나 문서를 이용하는 연구는 보건복지부령에 의해 IRB의 심의를 면제할 수 있도록 규정되어 있다. <br>
                                “기존의 자료나 문서”는 연구 시점에 이미 존재하는 정보로서 이를 이용하여 후향적으로 연구하는 것을 말한다.
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">인체유래물연구</h4>
                </div>
                <div class="rules-conbox">
                    <ul class="list-type list-type-dot">
                        <li>
                            기증자 및 공공에 미치는 위험이 미미한 인체유래물연구는 IRB 심의면제될 수 있는데, 연구자가 개인정보를 수집 • 기록하지 않은 연구 중
                            <ul class="list-type list-type-bar">
                                <li>통상적인 교육 과정의 범위에서 실무와 관련하여 수행하는 연구나</li>
                                <li>공중보건상 긴급한 조치가 필요한 상황에서 국가 또는 지방자치단체가 직접 수행하거나 위탁한 연구는 IRB면제가 가능하다.</li>
                            </ul>
                        </li>
                        <li>
                            역시 연구자가 개인정보를 수집 • 기록하지 않은 연구로서
                        </li>
                        <li>
                            편집인과 심사자는 논문에 기술된 연구가 피험자 동의 취득이나 IRB 승인에 대한 지침을 준수했는지 확인해야 할 의무가 있다.
                            <ul class="list-type list-type-text">
                                <li>
                                    <span>(1)</span>
                                    <div>
                                        인체유래물은행이 수집•보관하고 있는 인체유래물을 제공받아 사용하는 연구,
                                    </div>
                                </li>
                                <li>
                                    <span>(2)</span>
                                    <div>
                                        의료 기관에서 치료 및 진단을 목적으로 사용하고 남은 인체유래물을 이용하여 정확도 검사 등 검사실 정도관리 및 검사법 평가 등을 수행하는 연구,
                                    </div>
                                </li>
                                <li>
                                    <span>(3)</span>
                                    <div>
                                        인체유래물을 직접 채취하지 않는 경우로서 일반 대중이 이용할 수 있도록 인체유래물로부터 분리•가공된 연구재료(병원체, 세포주 등을 포함한다)를 사용하는 연구,
                                    </div>
                                </li>
                                <li>
                                    <span>(4)</span>
                                    <div>
                                        연구자가 인체유래물 기증자의 개인식별정보를 알 수 없으며, 연구를 통해 얻어진 결과가 기증자 개인의 유전적 특징과 관계가 없는 연구(배아줄기세포주를 이용한 연구는 제외)인 경우에는 IRB 심의면제가 된다.
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">날조, 변조</h4>
                </div>
                <div class="rules-conbox">
                    <p>
                        날조(Fabrication)는 존재하지 않는 데이터 또는 연구결과 등을 허위로 만들어 내는 행위이며, 변조(falsification) 는 연구재료, 장비, 과정 등을 인위적으로 조작하거나 데이터를 임의로 변형 삭제함으로써 연구 내용 또는 결과를 왜곡하는 행위를 의미한다.

                        연구자들은 연구자료를 날조나 변조해서는 안되며, 연구결과를 명확하고 정직하게 구체적으로 제시함으로써 연 구진실성을 준수해야 한다.
                    </p>
                </div>

                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">표절</h4>
                </div>
                <div class="rules-conbox">
                    <ol class="list-type list-type-decimal">
                        <li>
                            정의와 종류 <br>
                            표절(plagiarism)은 “타인의 아이디어, 과정(방법), 결과물, 문장 등을 적절한 인용이나 승인없이 도용하는 행위”를 말한다.
                            <ul class="list-type list-type-bar">
                                <li>표절은 연구의 계획, 수행, 논문 작성, 출판의 모든 단계에서 발생할 수 있으며, 아주 경미한 인용 실수에서부터 다른 사람의 지적 재산권을 침해하는 법적인 문제까지 매우 다양한 스펙트럼이 존재한다. 표절(plagiarism)은“타인의 아이디어, 과정(방법), 결과물, 문장 등을 적절한 인용이나 승인 없이 도용하는 행위” 를 말하며 표절의 대상은 크게 아이디어와 본문으로 나눌 수 있다.</li>
                                <li>다른 사람이 작성한 내용을 인용할 때는 적절한 사용 원칙을 준수하여야 한다.</li>
                                <li>표절은 엄격히 금지되는 행위이며 발견된 경우 적절한 주체가 판정하여 출판여부에 따라 게재불가, 게제 취소로 처리한다. 심각한 위반이 있는 경우 추가적인 제재를 가하기도 한다.</li>
                                <li>자기표절이라는 용어보다는 문장 재사용(text recycling)이라는 용어가 더 적절하며 연구출판윤리 위반인지 여부는 재사용 정도와 저자의 상황에 따라 다르다.</li>
                            </ul>
                        </li>
                        <li>
                            인용과 표절 <br>
                            다른 사람이 작성한 내용을 인용할 때는 적절한 사용 원칙을 준수하여야 한다. 다른 사람이 작성한 내용을 그대로 인용하여 사용하는 것을 verbatim이라고 한다. 이 경우는 인용하는 부분을 명확하게 하기 위해서 따옴표를 사용하도록 권고한다. <br><br>

                            다른 사람이 작성한 문서의 일부를 사용하면서 뜻이 변화하지 않는 범위 내에서 몇몇 단어를 바꾸거나 글의 순서를 바꾸어서 표현하는 경우를 바꿔 쓰기(paraphrasing)라고 한다. 바꿔 쓰기를 하더라도 참고한 문헌에 대한 인용 표시를 하여야 하며 원래 문장이 가지고 있는 의미가 그대로 전달될 수 있도록 하여야 한다. <br><br>

                            다른 사람이 작성한 문서의 일부를 사용하면서 그 내용을 줄여서 표현하는 것을 요약(summarizing)이라고 한다. <br>
                            요약도 바꿔 쓰기와 거의 유사한 원칙이 적용되어 적절한 인용표시를 하여야 하며 원래 내용의 아이디어와 용어를 완전히 이해한 후 자신만의 언어로 표현하여야 한다.
                        </li>
                        <li>
                            표절에 대한 처리 과정
                            <ul class="list-type list-type-text">
                                <li>
                                    <span>1)</span>
                                    <div>
                                        발견 <br>
                                        CrossCheck과 eTBLAST가 있다. CrossCheck는 CrossRef에서 운영하는 대표적인 표절 적발 프로그램으로 iThenticate software가 CrossRef에 있는 논문을 검색하여 비교하는 방식이며 프로그램이 전체 내용을 비교 단위인 “fingerprint”로 만들어서 시행한다.
                                    </div>
                                </li>
                                <li>
                                    <span>2)</span>
                                    <div>
                                        판정 <br>
                                        판정의 주체는 개별 학회의 간행위원회가 될수도 있고 윤리적인 문제만을 다루는 윤리위원회가 될 수도 있다. <br>
                                        개별 학 회에서 표절여부를 판정하기 어려운 경우 의편협 연구출판윤리위원회에 판정을 요청할 수도 있다. <br>
                                        판정 주체는 아래와 같이 표절의 정도에 대해 판단할 수 있다.
                                        <ul class="list-type list-type-dot">
                                            <li>경미한 표절 : 일부 표절이 있지만 그 정도가 경미한 것(예 : 짧은 구절을 복사한 정도의 표절, 자료에 대한 인용 표시를 하지 않음 등)</li>
                                            <li>중대한 표절 : 표절이 있고 그 정도가 중대한 것(예 : 많은 문장이나 자료를 저작권자의 허락 없이 사용하고 마치 자신이 작성한 것처럼 제시한 경우)</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <span>3)</span>
                                    <div>
                                        추후 조치 <br>
                                        현재 심사 중인 문헌에 경미한 표절이 있으면 저자에게 학술지의 입장을 알리고 저자에게 표절한 문장을 다시 기술하거나 참고문헌에 인용하도록 하고 심사 진행한다. <br>
                                        만일 중대한 표절이 있으면 책임저자에게 알리고 해명을 요청한다. 만일 저자 답변이 충분하고 합리적이면 (예 : 고의가 아닌 실수, 투고규정 모호함, 초보 연구자) <br>
                                        모든 저자에게 알리고 게재 불가 로 처리하면 되지만 응답이 없거나 저자 답변이 불충분하고 합리적이지 않으면 게재 불가 처리하고 추가적인 징계에 대해 논의한다. <br><br>

                                        이미 게재된 문헌에 경미한 표절이 있으면 저자에게 학술지의 입장을 알리고 인용하지 않은 저자에게 표절한 문장을 다시 기술하거나 참고문헌에 인용하도록 하는 등의 논문 수정을 저자와 상의한다. <br>
                                        중대한 표절이 있으면 책임저자에게 알 리고 해명을 요청한다. 만일 저자 답변이 충분하고 합리적이면 논문 게재를 취소(retraction)하고 이를 독자에게 알린다. <br>
                                        표 절로 저작권을 침해 받을 가능성이 있는 기관에 알린다. 응답이 없거나 저자 답변이 불충분하고 합리적이지 않으면 게재 취소 처리하고 추가적인 징계에 대해 논의한다.
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">연구 출판 윤리</h4>
                </div>
                <div class="rules-conbox">
                    <p>
                        저자됨은 1) 학술적 개념과 계획 혹은 자료의 수집이나 분석 혹은 해석을 하는데 있어서 상당한 공헌을 하고, 2) 논문을 작성하거나 중요한 내용을 수정하며, 3) 출간될 원고를 최종적으로 승인하는, 이 세 가지의 조건을 모두 만족시켜야 한다. 저자됨은 연구 팀에서 사전에 의논하여 정한다. 연구에 참여하였지만 저자의 조건을 갖지 않는 사람은 기여자로 분류하여 감사의 글에 게재해야 한다.
                    </p>
                    <ul class="list-type list-type-bar">
                        <li>부당한 저자의 유형으로 초빙(선물), 유령, 교환, 도용저자 등이 있다.</li>
                        <li>저자의 수, 순서에서 저자의 수는 가능한 줄이는 것이 좋고, 순서는 사전에 연구팀에서 정한다.</li>
                        <li>연구에 기여하였지만 부분적이어서 저자로 인정받지 못한 연구자를 기여자라고 하며 이들은 감사의 글에 언급한다.</li>
                        <li>책임저자는 학술지의 편집인이 보내는 논문 심사의 논평, 수정사항 등을 받아 연락하는 자이며, 제1저자는 연구에 가장 큰 기여를 한 사람으로 한다.</li>
                        <li>저자의 변경, 부당한 경우 저자됨이 발견되면 향후 절차는 권고지침에 따른다.</li>
                    </ul>
                    <ol class="list-type list-type-decimal">
                        <li>
                            원저(Original Article)는 인간을 대상으로 한 연구(임상적 조사 및 보고서)와 동물을 이용한 실험 및 생체 외 실험에 대한 연구(기초 과학 보고서)로 한다.원저는 참고문헌과 그림 및 사진의 설명을 포함하여 5,000 단어를 넘지 않아야 한다. 참고문헌의 수는 30개로 제한한다. 원저의 초록은 약어를 가능한 한 피하며, 250단어를 넘지 않아야 한다. 키워드(key words)는 최대 5개로 제한하며 Index Medicus에서 제공하는 Medical Subject Headings(MeSH)에 등재된 단어를 사용하도록 권장한다. 원저의 논문은 다음의 순서로 작성해야 한다:
                            <ul class="list-type list-type-text">
                                <li>
                                    <span>1)</span>
                                    <div>
                                        표지(Title Page), 2) 초록 및 키워드(Abstract and Key Words), 3) 본문(Main Body), 4) Acknowledgements, 5) 참고문헌(References), 6) 도표(Tables), 7) 그림 및 사진의 설명(Figure Legends).
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li>종설(Review Article)은 특정 분야나 주제에 관해 간결하고 포괄적으로 평가한 논문으로 위촉된 종설에 한하여 게재하는 것을 원칙으로 한다. 위촉되지 않은 종설은 편집진의 재량에 따라 게재 가능하다. 종설 원고에서 인용하는 참고문헌의 수는 제한하지 않는다. 초록은 약어를 가능한 한 피하며, 250단어를 넘지않아야 한다. 키워드(key words)는 최대 5개로 제한하며 Index Medicus에서 제공하는 Medical Subject Headings (MeSH)에 등재된 단어를 사용하도록 권장한다.</li>

                        <li>논평(Editorial)은 심장 율동과 관련되며, 부정맥연구회 회원 및 개원의의 지속적인 의학 교육에 유의하다고 판단되는 논문에 대한 저자의 견해를 기술하는 논문이며, 편집진의 의뢰 하에 쓰여진다. 논평은 참고문헌과 도표, 그림 및 사진의 설명을 제외하고 2,000 단어를 넘지 않아야 한다.</li>

                        <li>증례 보고(Case Report)는 임상적, 교육적 가치가 있는 희귀 증례에 대한 논문으로 제한한다. 증례 보고 원고의 저자 수는 8명 이상을 넘지 않도록 제한하며, 참고문헌과 그림 및 사진의 설명을 포함하여 3,000 단어를 넘지 않아야 한다. 초록은 약어를 가능한 한 피하며, 250단어를 넘지 않아야 한다. 키워드(key words)는 최대 5개로 제한하며 Index Medicus에서 제공하는 Medical Subject Headings (MeSH)에 등재된 단어를 사용하도록 권장한다. 참고문헌의 수는 10개로 제한한다. 일반적인 증례보고 원고는 Introduction, Case, Discussion의 제목을 달아 구성한다.</li>
                    </ol>
                </div>

                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">이해관계</h4>
                </div>
                <div class="rules-conbox">
                    <ul class="list-type list-type-bar">
                        <li>연구출판윤리에서 이해관계(COI)는 연구결과를 왜곡할 수 있기 때문에 확실하게 밝히는 것이 중요하다.</li>
                        <li>이해관계는 재정적인 것 이외에도 다양한 유형이 존재한다.</li>
                        <li>ICMJE는 이해관계를 보고할 때 사용하는 공통형식을 사용할 것을 제안하고 현재 가장 많이 사용되고 있다.</li>
                        <li>각 학술지에선 이해관계에 관한 항목을 투고자에게 사전에 알리는 것이 중요하고 이해관계 고시문에 대한 형식을 준비하거나 ICMJE형식에 따라 운용한다.</li>
                    </ul>
                </div>

                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">중복출판</h4>
                </div>
                <div class="rules-conbox">
                    <ul class="list-type list-type-bar">
                        <li>중복출판이란 이미 출판된 논문과 상당부분 겹치는 내용을 다시 출판하는 경우로 복사, 분할출판, 덧붙이기 출판 등이 있다.</li>
                        <li>중복출판 중 허용되는 경우를 이차출판이라고 하며 해당 요건을 만족한 경우, 학위 논문, 초록 등이 여기에 해당한다.</li>
                        <li>중복출판은 엄격히 금지되는 행위이며 발견된 경우 적절한 주체가 판정하여 출판여부에 따라 게재불가, 게재 취소로 처리한다. <br>
                            심각한 위반이 있는 경우 추가적인 제재를 가하기도 한다.
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection