@extends($extends_str)

@section('addStyle')
@endsection

@section('contents')

    <article class="sub-contents">
        <div class="sub-conbox inner-layer">
            @include('layouts.include.subTit')
            
            <div class="sub-tab-wrap">
                <a href="#n" class="btn-tab-menu js-btn-tab-menu">목적과 개요</a>
                <ul class="sub-tab-menu n6 cf js-tabcon-menu">
                    <li class="on"><a href="#n">목적과 개요</a></li>
                    <li><a href="#n">연구 및 <br>출판 윤리 규정</a></li>
                    <li><a href="#n">원고 범위</a></li>
                    <li><a href="#n">집필 규정</a></li>
                    <li><a href="#n">원고의 형식</a></li>
                    <li><a href="#n">판권(Copyright)및 <br>원고 접수</a></li>
                </ul>
            </div>
            <div class="sub-tab-con js-tab-con" style="display: block;">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">목적과 개요</h4>
                </div>
                <div class="rules-conbox">
                    <p>
                        International Journal of Arrhythmia는 대한부정맥학회의 주관으로 발행되며, 공식 약어는 'Int J Arrhythm'으로 표기한다. International Journal of Arrhythmia는 부정맥과 관련된 새로운 임상 지식, 진료 지침, 증례 등을 소개하여 대한부정맥학회 회원 및 개원의의 지속적인 의학 교육에 이바지하고자 발행되는 최신 학술지이다. 본 지는 부정맥의 진단과 치료, 임상 연구와 관련된 원저, 종설, 논평, 증례 보고 등을 편집위원회의 검토 및 전문가의 심사를 거쳐 게재하는 학술지이다. <br><br>

                        본 지는 1년 4회의 주기로 3월, 6월, 9월, 12월의 마지막 날에 국문 혹은 영문(종설 원고)과 영문(원저, 증례보고)으로 발행한다. 본 지는 인쇄 출판물과 공식 홈페이지(<a href="http://e-arrhythmia.org" target="_blank" class="link">http://e-arrhythmia.org</a>)의 온라인 출판물로 발행된다.
                    </p>
                </div>
            </div>

            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">연구 및 출판 윤리 규정</h4>
                </div>
                <div class="rules-conbox">
                    <p>
                        본 규정은 대한부정맥학회 회원들의 학술 활동 중 연구 윤리를 확보하는 데 필요한 역할과 책임에 관하여 기본적인 원칙과 방향을 제시하기 위하여 제정되었으며, 각 회원은 연구 활동 중 정직성, 진실성, 정확성이 연구 결과의 신뢰성 확보를 위한 필수 조건임을 인식하고 모든 연구 활동을 수행함에 있어 이 규정을 준수하도록 한다.
                    </p>
                    <ol class="list-type list-type-decimal">
                        <li>저자는 International Committee of Medical Journal Editors (ICMJE) Recommendations for the Conduct, Reporting, Editing and Publication of Scholarly Work in Medical Journals. (<a href="http://www.icmje.org/icmje-recommendations.pdf" target="_blank" class="link">http://www.icmje.org/icmje-recommendations.pdf</a>)에서 규정한 윤리 규정을 준수해야 한다.</li>

                        <li>본 학술지에 투고하는 원고의 연구 대상이 사람인 경우는 헬싱키선언(Declaration of Helsinki [<a href="http://www.wma.net" target="_blank" class="link">www.wma.net</a>])의 윤리 기준에 일치해야 하며 윤리위원회 또는 임상시험심사위원회(Institutional Review Board)의 승인을 받아야 하며 관련된 내용을 원고 내에 명시해야 한다.</li>

                        <li>연구 대상이 동물인 경우 실험 과정이 연구 기관의 윤리위원회의 규정이나 NIH Guide for the Care and Use of Laboratory Animals의 기준에 합당하거나 Institutional Animal Care and Use Committees (IACUCs)의 사육 및 연구의 승인을 받아야 하며, 병원균을 이용하는 경우 Institutional Biosafety Committee(IBC)의 생물학적 안전성에 대해 승인이 필요하다.</li>

                        <li>본 학술지의 간행위원회는 필요한 경우에 연구대상자의 동의서 사본이나 윤리위원회 승인서의 제출을 요구할 수 있다.</li>

                        <li>'저자'란 출판하는 논문의 연구에 실제적인 지적 공헌(substantial intellectual contributions)을 한 사람을 칭한다. 실제적인 지적 공헌이란 1) 연구의 개념과 설계에 참여, 데이터의 수집 및 해석, 2) 논문 초안 작성에 참여, 3) 논문 최종본을 승인, 4) 논문의 전체, 또는 일부분의 정확성과 완전성에 대해 보장하고 책임질 수 있음을 의미하며, 저자는 1, 2, 3, 4의 항목에 모두 주요한 공헌을 한 사람에 준한다. 교신저자는 위의 네 조건을 모두 충족하는 저자 중 논문의 출판 이후의 모든 과정에 직접 연락을 취할수 있어야 한다. 단체 저자로서 논문을 등록하는 경우 교신저자는 반드시 적절한 표시를 통해 명시해야 하며, 단체 저자명을 표기하는 외에 각 저자 개인의 이름이 기술해야 한다.</li>

                        <li>저자의 결정이나 논문의 방향에 영향을 미칠 수 있는 모든 종류의 이해관계는 반드시 명시해야 한다. 학술지의 편집인은 결과분석에 영향을 미칠 가능성이 있는 이해관계에 대해 교신저자에게 명시할 것을 요청할 수 있으며, 모든 저자는 논문을 투고 하기 전 이해관계에 대해 명확히 확인해야 한다. 특히 연구에 소요된 연구비 수혜 내용은 감사의 글에 필히 기입해야 한다. 연구에관계된 주식, 자문료 등 이해관계가 있는 모든 것은 논문 내에서 밝혀져야 하며, 이를 모두 명시했음을 이해관계에 대한 확인서(disclosure of potential conflicts of interest)를 작성하여 제출해야 한다. 이러한 이해 충돌은 제약 회사나 이해 관계에 있는 단체의 압력과 관련하여 연구비 지원이나 개인적 유착 관계를 근절하기 위함이다. 모든 종류의 이해 관계는 반드시 논문 본문의 마지막 'Acknowledgment' 부분에서 명시해야한다.</li>

                        <li>다른 학술지에 투고하여 전문가 심사를 받는 중이거나 이미 발표한 논문을 본 학술지에 투고나 게재할 수 없으며, 본 학술지에 출판한 논문은 편집위원회의 허락 없이 다른 학술지에 투고나 게재할 수 없다. ICMJE의 Recommendations for the Conduct, Reporting, Editing and Publication of Scholarly Work in Medical Journals (<a href="http://www.icmje.org/" target="_blank" class="link">http://www.icmje.org/</a>)에서 제안한 조건에 맞으면 이차출판 할 수 있다. 다른 국가, 다른 언어, 다른 학술지에서 발행할 때 이차출판할 수 있다. 이 경우 저자는 양쪽 저널의 간행위원장에게 허락을 받아야 한다. 이차출판은 독자층이 달라야 하고 축약본만으로도 가능하다. 또한 원 논문 자료와 해석을 충실히 따라야 하며 투고 원고 첫 페이지에 각주를 통해서 독자, 심사자, 사무국에 현 원고 전체나 일부분이 다른 학술지에출판되었음을 알려야 한다.</li>

                        <li>윤리 규정 및 표절/중복게재/연구부정행위 등 모든 연구 윤리와 연계되는 사항에 대한 심사 및 처리 절차는 the Council of Science Editors, International Committee of Medical Journal Editors, World Association of Medical Editors에서 규정하는 윤리 가이드라인과 대한의학학술지편집인협의회에서 제정한 ' Good Publication Practice Guidelines for Medical Journals (<a href="http://kamje.or.kr/intro.php?body=publishing_ethics" target="_blank" class="link">http://kamje.or.kr/intro.php?body=publishing_ethics</a>)'을 따른다. 어떠한 조건에서도 심사자의 신원은 노출하지 않는다.</li>

                    </ol>
                </div>
            </div>

            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">원고 범위</h4>
                </div>
                <div class="rules-conbox">
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
            </div>

            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">집필 규정</h4>
                </div>
                <div class="rules-conbox">
                    <ol class="list-type list-type-decimal">
                        <li>
                            모든 원고는 International Committee of Medical Journal Editors(ICMJE) Recommendations for the Conduct, Reporting, Editing and Publication of Scholarly Work in Medical Journals. (<a href="http://www.icmje.org/icmje-recommendations.pdf" target="_blank" class="link">http://www.icmje.org/icmje-recommendations.pdf</a>)에서 규정한 윤리 규정을 준수해야 한다.
                        </li>

                        <li>모든 원저와 증례 보고는 영어, 종설과 논평은 한글 또는 영어를 사용하여 맞춤법에 맞게 작성하며 Microsoft Word (doc)나 다른 워드 프로세스 프로그램을 이용하여 작성해야 한다. 모든 원고는 10 point 사이즈, 줄간격은 2로 지정한다. 본문 내 참고 문헌, 도표, 그림 및 사진의 인용은 숫자 순서(numeric order)로 매김한다. 모든 학술 용어는 대한의사협회에서 발간한 의학용어집의 최신판에 수록된 용어를 사용한다.</li>

                        <li>한글로 작성하는 원고는 원어의 적당한 한글 용어가 없는 경우 한글 뒤 ( )안에 원어를 표기할 수 있다. 부득이 외국어를 사용할 때 는 대소문자의 구별을 정확히 해야 한다(예：고유명사, 지명, 인명은 첫 글자를 대문자로 하고 그 외에는 소문자로 기술함을 원칙으로 한다). 적절한 번역어가 없는 의학용어, 고유명사, 약품명, 단위 등은 원어를 그대로 사용한다.</li>

                        <li>번역어가 있으나 의미 전달이 명확하지 않은 경우에는 그 용어가 최초로 등장할 때 번역어 다음 소괄호 속에 원어로 표기하고 그 이후로는 번역어만 사용한다.</li>

                        <li>검사실 검사 수치의 단위는 SI 단위(International System of Units)를 사용하고, 편집위원회의 요구나 필요에 따라 괄호 안에 비SI 단위 수치를 첨부할 수 있다.</li>
                    </ol>
                </div>
            </div>

            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">원고의 형식</h4>
                </div>
                <div class="rules-conbox">
                    <ol class="list-type list-type-decimal">
                        <li>
                            표지(Title Page)
                            <ul class="list-type list-type-bar">
                                <li>
                                    표지에는 다음의 사항이 반드시 기입해야 한다:
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>①</span>
                                            <div>
                                                Title은 공백을 포함하여 100 문자(character)까지로 제한한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>②</span>
                                            <div>
                                                Running title은 공백을 포함하여 50 문자(character)까지로 제한한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>③</span>
                                            <div>
                                                저자명, 학위 및 소속이 반드시 기입해야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>④</span>
                                            <div>
                                                주소는 도로명 주소를 사용한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑤</span>
                                            <div>
                                                교신저자의 정보가 기입해야 한다.
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li>
                            초록 및 키워드(Abstract and Key Words)
                            <ul class="list-type list-type-text">
                                <li>
                                    <span>①</span>
                                    <div>
                                        원저, 종설, 증례 보고의 초록은 영어로 작성해야 한다.
                                    </div>
                                </li>
                                <li>
                                    <span>②</span>
                                    <div>
                                        초록에는 인용이 없어야 한다.
                                    </div>
                                </li>
                                <li>
                                    <span>③</span>
                                    <div>
                                        초록에서는 가능한 한 약어의 사용을 피한다. 불가피한 경우 약어가 처음 사용되는 시점에서 괄호 내에 약어를 풀어 사용한다.
                                    </div>
                                </li>
                                <li>
                                    <span>④</span>
                                    <div>
                                        최대 250단어를 사용할 수 있다.
                                    </div>
                                </li>
                                <li>
                                    <span>⑤</span>
                                    <div>
                                        원저의 초록은 아래의 제목을 달아 구성한다.
                                        <ul class="list-type list-type-bar">
                                            <li>Background and Objectives—연구의 합리성을 서술한다.</li>
                                            <li>Subjects (Materials) and Methods—연구의 설정과 주요한 방법을 기술한다.</li>
                                            <li>Results—주요한 연구 결과에 대해 간결하게 기술한다; 이 섹션에서는 연구 상의 연구 표본군의 사이즈를 함께 명시한다.</li>
                                            <li>Conclusion—분석된 결과에 대해 서술한다.</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <span>⑥</span>
                                    <div>
                                        종설과 증례 보고의 초록은 형식을 규정하지 않는다.
                                    </div>
                                </li>
                                <li>
                                    <span>⑦</span>
                                    <div>
                                        키워드(key words)는 최대 5개로 제한하며 Index Medicus에서 제공하는 Medical Subject Headings (MeSH)에 등재된 단어를 사용 하도록 권장한다.
                                        <ul class="list-type list-type-bar">
                                            <li>적절한 단어가 등재되지 않은 경우 새로운 키워드를 사용할 수 있다.</li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li>
                            본문(Text)
                            <ul class="list-type list-type-text">
                                <li>
                                    <span>①</span>
                                    <div>원저는 일반적으로 다음의 소제목을 달아 구성한다:
                                        <ul class="list-type list-type-bar">
                                            <li>
                                                Introduction, Subjects (Materials) and Methods, Results, Discussion, Conclusion, Acknowledgments 종설은 서론과 결론의 소제목을 달아 구성하며, 본론은 각 내 용에 적합한 소제목을 달아 구분한다. Editorial은 요약, 고찰의 소제목을 달아 구성한다.
                                            </li>
                                            <li>
                                                증례 보고는 Introduction, Case, Discussion의 소제목을 달아 구성한다.
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <span>②</span>
                                    <div>
                                        약어를 사용해야 하는 경우, 용어가 처음 나올 때 괄호 안에 약어를 함께 표기하고 다음부터 약어를 사용할 수 있다.
                                    </div>
                                </li>
                                <li>
                                    <span>③</span>
                                    <div>
                                        논문의 서론에는 배경과 연구의 목적이 언급해야 한다.
                                    </div>
                                </li>
                                <li>
                                    <span>④</span>
                                    <div>
                                        대상(재료) 및 방법은 매우 상세히 기재해야 하며 결과의 통계적 검증 방법도 밝혀야 한다. 방법과 결과는 단독으로 제공되어도 독자로 하여금 충분히 이해될 수 있고, 재현이 가능하도록 정보를 제공해야 한다. 사람 또는 동물을 대상으로 진행된 연구는 반드시 그 연구 과정이 기술해야 하며 적절한 윤리위원회의 인허를 받았음을 명시해야 한다.
                                    </div>
                                </li>
                                <li>
                                    <span>⑤</span>
                                    <div>
                                        결과는 적절한 도표, 사진 및 그림으로 설명될 수 있으며, 저자는 전체 연구 결과에 접근할 수 있고, 이 결과에 대해 책임을 가질 의무가 있다. <br>
                                        International Journal of Arrhythmia의 편집위원회는 논문의 편향성을 최소화하고, 원본 정보의완전성과 수행된 정보 분석을 검증하기 위하여 교신저자에게 추가 정보의 제공을 요청할 권리가 있다.
                                    </div>
                                </li>
                                <li>
                                    <span>⑥</span>
                                    <div>
                                        고찰은 연구와 관련된 새로운 정보 해석의 고찰과 연구의 결론을 포함한다. 서론에서 언급한 연구 목적과 부합해야 한다.
                                    </div>
                                </li>
                                <li>
                                    <span>⑦</span>
                                    <div>
                                        모든 참고문헌, 사진 및 그림, 도표는 본문 중에서 인용되는 순서대로 나열해야 한다.
                                    </div>
                                </li>
                            </ul>
                        </li>

                        <li>
                            감사문(Acknowledgments)
                            <ul class="list-type list-type-bar">
                                <li>모든 종류의 재정 지원에 대해 연구비 및 연구비 지원기관의 이름이 명시해야 한다. 지원기관의 이름은 약어를 사용하지 않는다. 본 연구를 수행하는 데 저자의 자격에는 부합하지 않으나, 연구에 도움을 준 기여자(contributors)의 이름을기술한다. 언급할 사항이 없는 경우 필수 사항은 아니다.</li>
                            </ul>
                        </li>

                        <li>
                            참고문헌(References)
                            <ul class="list-type list-type-bar">
                                <li>
                                    학술지를 참고문헌으로 인용하고자 할 때 International Journal of Arrhythmia에서 요구하는 인용 방식은 아래에서 서술하는 바와 같다. 그 외의 다른 자료의 인용은 NLM (National Library of Medicine)에서 제공하는 Style Guide for Authors를 따른다.
                                    <ul class="list-type list-type-text">
                                        <li>
                                            <span>①</span>
                                            <div>
                                                저자는 인용된 참고문헌의 정확성에 대한 책임이 있다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>②</span>
                                            <div>
                                                모든 참고문헌의 원본을 입증할 수 있어야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>③</span>
                                            <div>
                                                참고문헌을 기입할 때 참고문헌의 저자를 et al.을 이용하여 축약하지 않는다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>④</span>
                                            <div>
                                                참고 문헌의 예
                                                <ul class="list-type list-type-bar">
                                                    <li>Tilz R, Boveda S, Deharo JC, Dobreanu D, Haugaa KH, Dagres N. Replacement of implantable cardioverter defibrillators</li>
                                                    <li>and cardiac resynchronization therapy devices: results of the European Heart Rhythm Association survey. Europace.  </li>
                                                    <li>2016;18:945-949.</li>
                                                </ul>
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑤</span>
                                            <div>
                                                모든 참고문헌, 사진 및 그림, 도표는 본문 중에서 인용되는 순서대로 나열해야 하며, 참고문헌 목록의 순서와 일치해야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑥</span>
                                            <div>
                                                개인적 대화, 출판된 기록이 없는 발표, 출판이 되지 않은 투고 논문은 참고문헌으로 이용할 수 없다. 이러한 자료는 본문 내에서 저자명,학위, 출판되지 않은 정보, 정보를 입수한 연도를 기술하여 이용할 수 있다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑦</span>
                                            <div>
                                                학술지를 참고문헌으로 이용할 때에는 peer-review 과정을 거친 학술지 전문에서 인용해야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑧</span>
                                            <div>
                                                초록 자료만 존재하는 경우 반드시 참고문헌에 초록임을 명시해야 한다.
                                            </div>
                                        </li>
                                        <li>
                                            <span>⑨</span>
                                            <div>
                                                출판이 진행중인 자료는 학술지 또는 도서의 출판사에 대한 정보가 반드시 포함해야 한다.
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li>
                            도표(Table)
                            <ul class="list-type list-type-text">
                                <li>
                                    <span>①</span>
                                    <div>
                                        도표는 별도의 페이지에 줄간격 2의 설정으로 기술해야 한다. 도표는 Excel 프로그램으로 제출할 수 없으며, 워드프로세스 프로그램으로 작성해야 한다.
                                    </div>
                                </li>
                                <li>
                                    <span>②</span>
                                    <div>
                                        영문과 아라비아 숫자로 기록하며 도표의 제목을 명료하게 절 혹은 구의 형태로 기술한다. 문장의 첫 자를 대문자로 한다.
                                    </div>
                                </li>
                                <li>
                                    <span>③</span>
                                    <div>
                                        도표의 글씨체는 동일하게 유지한다.
                                    </div>
                                </li>
                                <li>
                                    <span>④</span>
                                    <div>
                                        각각의 열에 적절한 제목을 제시해야 한다.
                                    </div>
                                </li>
                                <li>
                                    <span>⑤</span>
                                    <div>
                                        기호를 사용할 때는 *, †, ‡, §, ∥, ¶, **, ††, ‡‡의 순으로 하며 이를 하단 각주에 설명한다.
                                    </div>
                                </li>
                                <li>
                                    <span>⑥</span>
                                    <div>
                                        약어를 사용할 때는 해당표의 하단에 알파벳순으로 풀어서 설명한다.
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            그림 및 사진(Figure)
                            <ul class="list-type list-type-text">
                                <li>
                                    <span>①</span>
                                    <div>
                                        사진의 경우 300 dpi 이상, 그림 도식의 경우 100% dpi 이상의 GIF, TIFF, EPS, JPG 형식의 파일로 제공해야 한다. 사진과 그림은 선명 하여 개체의 식별이 가능하여야 한다.
                                    </div>
                                </li>
                                <li>
                                    <span>②</span>
                                    <div>
                                        그림 및 사진은 적절한 설명이 필요하며, 그림이나 사진 내에 설명이 필요한 경우 동일한 크기와 스타일의 알파벳이나 화살표를 이용한다.
                                        <ul class="list-type list-type-bar">
                                            <li>이 경우 폰트는 10 point 이상으로 작성해야 한다. 사진이나 그림 내에 문자나 약자를 이용해 설명하는 경우 사진이나 그림 아래의 각주를 통해 그것에 대해 설명해야 한다.</li>
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <span>③</span>
                                    <div>
                                        사진 자료의 경우 배율을 표시해야 한다.
                                    </div>
                                </li>
                                <li>
                                    <span>④</span>
                                    <div>
                                        그림 및 사진의 설명은 본문을 작성할 때 함께 제공하며, 별 지에 영문으로 구나 절이 아닌 문장형태로 기술한다.
                                    </div>
                                </li>
                                <li>
                                    <span>⑤</span>
                                    <div>
                                        약어를 사용할 때는 해당 그림의 하단에 알파벳순으로 풀어서 설명한다.
                                    </div>
                                </li>
                                <li>
                                    <span>⑥</span>
                                    <div>
                                        기호를 사용할 때는 *, †, ‡, §, ∥, ¶, **, ††, ‡‡의 순으로 하며 이를 하단 각 주에 설명한다.
                                    </div>
                                </li>
                                <li>
                                    <span>⑦</span>
                                    <div>
                                        그림 및 사진 자료는 최대한 여백을 제거하여 등록한다.
                                    </div>
                                </li>
                                <li>
                                    <span>⑧</span>
                                    <div>
                                        그림의 마지막에는 마침표(period; .)를 이용해 끝마친다.
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            보충 자료(Supplementary Materials)
                            <ul class="list-type list-type-bar">
                                <li>보충 자료는 온라인 출판에만 제공된다. 보충 자료는 1) 인쇄 출판이 어려운 애니메이션, 동영상 자료, 음성 자료, 2) 전자 자료로서 제공해야 독자의 편리성을 배가하는 자료, 3) 대형 원본 자료, 부가 도표, 설명 등에 해당되는 경우 보충 자료로 제공할 수 있다.</li>
                            </ul>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">판권(Copyright) 및 원고 접수</h4>
                </div>
                <div class="rules-conbox">
                    <p>
                        출판되는 모든 논문의 영구적 재산권은 대한부정맥학회와 MMK Communications Limited에 귀속되며, 문서로 규정된 인허 없이는 타 지에 게재할 수 없다. 논문의 투고 시 저작권 이양 동의서가 반드시 함께 투고되어야 한다. <br><br>

                        모든 원고는 온라인 시스템을 통해 등록해야 한다. 온라인 투고시스템으로 진행하기 전 원고가 'International Journal of Arrhythmia 투고 및 윤리 규정'에 알맞게 작성되었는지 확인해야 한다. 원고의 투고가 준비되면 <a href="http://submit.e-arrhythmia.org/" target="_blank" class="link">http://submit.e-arrhythmia.org/</a> 에 원고를 등록한다.
                    </p>
                </div>
            </div>
        </div>
    </article>
@endsection

@section('addScript')

@endsection