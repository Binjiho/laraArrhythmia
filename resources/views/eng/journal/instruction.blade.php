@extends('eng.layouts.eng-layout')

@section('addStyle')
@endsection

@section('contents')
    <article class="sub-contents">
        <div class="sub-conbox authors-conbox inner-layer">
            <div class="sub-tit-wrap">
                <h3 class="sub-tit">Instruction to Authors</h3>
            </div>
            <div class="sub-tab-wrap">
                <a href="#n" class="btn-tab-menu js-btn-tab-menu">Aims and Scopes</a>
                <ul class="sub-tab-menu n6 js-tabcon-menu">
                    <li class="on"><a href="#n">Aims and Scopes</a></li>
                    <li><a href="#n">Research and <br>Publication Ethics <br>(Date of enactment)</a></li>
                    <li><a href="#n">Journal Categories</a></li>
                    <li><a href="#n">Manuscript Preparation</a></li>
                    <li><a href="#n">Manuscript Format</a></li>
                    <li><a href="#n">Copyright & General <br>Online Submission <br>Information</a></li>
                </ul>
            </div>

            <!-- s:Aims and Scopes -->
            <div class="sub-tab-con js-tab-con" style="display: block;">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">Aims and Scopes</h4>
                </div>
                <p>
                    The International Journal of Arrhythmia is the official journal of the Korean Heart Rhythm Society. Abbreviated title is <i>'Int J Arrhythm'</i>. <br><br>

                    The International Journal of Arrhythmia is the journal aim to introduce new clinical knowledges, basic findings, techniques, practice guidelines, cases which are related to arrhythmias, and issues of interest to the society members. And this journal has an aim to contribute to continuous medical education of physicians. The International Journal of Arrhythmia is a peer-reviewed journal that publishes original articles, review articles, editorials, case reports related to diagnosis and treatment, and clinical and basic researches related to arrhythmia. The International Journal of Arrhythmia is published quarterly on the last day of March, June, September and December in Korean and English (review, original article, case report). <br><br>

                    This journal is published in print and is also available on the official website (<a href="http://e-arrhythmia.org" target="_blank" class="link">http://e-arrhythmia.org</a>).

                </p>
            </div>
            <!-- // e:Aims and Scopes -->

            <!-- s:Research and Publication Ethics (Date of enactment) -->
            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">Research and Publication Ethics (Date of enactment)</h4>
                </div>
                <p>
                    These policies are legislated to render underlying principles and directions about the role and responsibilities to secure the research ethic through academic activities. All authors are recommended to recognize that truthfulness, veracity, and accuracy are prerequisites for reliability and should observe these policies.
                </p>
                <ol class="list-type list-type-decimal">
                    <li>All manuscripts must comply with the research and publication ethics guidelines recommended by the International Committee of Medical Journal Editors (ICMJE) for the Conduct, Reporting, Editing and Publication of Scholarly Work in Medical Journals (<a href="http://www.icmje.org/icmje-recommendations.pdf" target="_blank" class="link">http://www.icmje.org/icmje-recommendations.pdf</a>).</li>
                    <li>In all manuscripts, authors should refer to the principles embodied in the Declaration of Helsinki (<a href="http://www.wma.net/en/30publications/10policies/b3/index.html" target="_blank" class="link">http://www.wma.net/en/30publications/10policies/b3/index.html</a>) for all investigations involving human materials and be reviewed by Institutional Biosafety Committee (IBC).</li>
                    <li>Animal experiments also should be reviewed by the Institutional Animal Care and Use Committees (IACUC) for the care and use of animals. Also studies with pathogens requiring a high degree of biosafety should pass a review by the Institutional Biosafety Committee (IBC).</li>
                    <li>If necessary, the editorial board may request copies of informed consents from human subjects in clinical studies or IRB approval documents.</li>
                    <li>'Author' is defined as person who contributed substantial intellectual contributions to the manuscript. The substantial intellectual contribution is defined as 1) to participate in the conception and design, acquisition of data, or analysis and interpretation of data; 2) drafting the article or revising it for intellectual content; 3) final approval to be published; and 4) agreement to be accountable for all aspects of the work in ensuring that questions related to the accuracy or integrity of any part of the work are appropriately investigated and resolved. All authors should meet all four criteria. The corresponding author is defined as an author who meets the four criteria and also should be available throughout the full processes and after publication. When submitting a manuscript authored by a group, the corresponding author should clearly indicate the preferred citation and identify all individual authors as well as the group name.</li>
                    <li>A conflict of interest may exist when an author (or the author's institution or employer) has financial or personal relationships or affiliations that could influence (or bias) the author's decisions, work, or manuscript. The corresponding author of an article can be asked to inform the Editor of the authors' potential conflicts of interest which could possibly influence their interpretation of data and all authors should clearly disclose their potential conflicts of interest before submitting the article. In particular, all sources of funding for a study should be stated explicitly. All authors must write and submit the form for disclosure of potential conflicts of interest. Otherwise, such conflicts may be financial support or private connections to pharmaceutical companies, political pressure from interest groups, or academic conflicts. All sources of funding should be declared in a section titled "Acknowledgment" at the end of the text.</li>
                    <li>Manuscripts under review or published by other journals will not be accepted for publication, and articles published in this journal are not allowed to be reproduced in whole or in part in any type of publication without permission of the Editorial Board. It is possible to republish manuscripts if the manuscripts satisfy the condition of secondary publication of the "Recommendations for the Conduct, Reporting, Editing and Publication of Scholarly Work in Medical Journals" (http://www.icmje.org/publishing_4overlap.html). Secondary publication for various other reasons, in the different journal, another language, especially in other countries, is justifiable and can be beneficial provided that the following conditions are met. In such instances, the author has to receive approval from the editor-in-chief of both journals. The paper for secondary publication is intended for a different group of readers; an abbreviated version could be sufficient. The secondary version faithfully reflects the data and interpretations of the primary version. The footnote on the title page of the secondary version informs readers, peers, and documenting agencies that the paper has been published in whole or in part and states the primary reference.</li>
                    <li>All manuscripts should be prepared in strict observation of the research and publication ethics guidelines recommended by the Council of Science Editors, International Committee of Medical Journal Editors, World Association of Medical Editors, and the Korean Association of Medical Journal Editors ("Good Publication Practice Guidelines for Medical Journals" <a href="http://kamje.or.kr/intro.php?body=publishing_ethics" target="_blank" class="link">http://kamje.or.kr/intro.php?body=publishing_ethics</a>)., The identities of the referees will not be disclosed under any circumstances.</li>
                </ol>
            </div>
            <!-- // e:Research and Publication Ethics (Date of enactment) -->

            <!-- s:Journal Categories -->
            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">Journal Categories</h4>
                </div>
                <ol class="list-type list-type-decimal">
                    <li>
                        <strong>Original Articles</strong>
                        <p>
                            Original articles includes clinical investigations and reports using human subjects and basic science reports using laboratory animals and in vitro experiments. <br><br>

                            Original articles should not exceed 5,000 words including references and legends. The number of references is limited to 30 reports. Abstract of the original article should be written with less than 250 words (avoid abbreviations when possible). Keywords (5 words maximum) are recommended to be from the Medical Subject Headings (MeSH) list of Index Medicus. The manuscript should be arranged in the following sequence: 1) Title Page, 2) Abstract and Keywords, 3) Main Body, 4) Acknowledgements, 5) References, 6) Tables, and 7) Figure Legends.
                        </p>
                    </li>
                    <li>
                        <strong>Review Articles</strong>
                        <p>
                            Review articles are concise and comprehensive articles devoted to reviewing a certain area or topic. The majority of reviews are commissioned. Noncommissioned articles are considered at the editor's discretion. These articles should be comprehensive analyses of specific topics. The numbers of words and references for reviews are not limited. Abstracts less than 250 words are to be included and written in English. Keywords (5 words maximum) are recommended to be used from the Medical Subject Headings (MeSH) list of Index Medicus.
                        </p>
                    </li>
                    <li>
                        <strong>Editorials</strong>
                        <p>
                            Generally, editorials are commentaries on notable articles with active areas of research, fresh insights, and debates in all fields of cardiac rhythm. The majority of editorials are commissioned. Editorials should not exceed 2,000 words, excluding references, tables, and figures.
                        </p>
                    </li>
                    <li>
                        <strong>Case Reports</strong>
                        <p>
                            Case reports are limited to papers on a rare case with clinical and educational value. The maximum number of authors for a case report should not exceed 8. Case reports should not exceed 3,000 words including references and legends. Abstracts should not exceed 250 words. Keywords (5 words maximum) are recommended to be used from the Medical Subject Headings (MeSH) list of Index Medicus. The number of references is limited to 10 reports. Typical main headings of the text include 1) Introduction 2) Case, and 3) Discussion.
                        </p>
                    </li>
                </ol>
            </div>
            <!-- // e:Journal Categories -->

            <!-- s:Manuscript Preparation -->
            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">Manuscript Preparation</h4>
                </div>
                <ol class="list-type list-type-decimal">
                    <li>All manuscripts are prepared in strict observation of the research and publication ethics guidelines recommended by the International Committee of Medical Journal Editors (ICMJE) Recommendations for the Conduct, Reporting, Editing and Publication of Scholarly Work in Medical Journals.</li>
                    <li>All manuscripts for original articles and case reports must be written in clear, appropriate English, and review articles and editorials must be written in clear, appropriate Korean or English, using Microsoft Word (doc) or other major word-processing programs. The manuscript must be double spaced in 10-point font with the title page, abstract, text, references, figure legends, and tables included. Cite references, figures, and tables in numeric order.</li>
                    <li>Manuscripts written in Korean are able to refer to original English terms along with Korean terms if there is no proper alternative in Korean. If a language other than Korean is used, capitalization must be accurate (for example: capitalize an initial letter of proper nouns, names of a place, personal names). Medical jargon, proper nouns which are hard to translate, names of medicines or chemicals, and units should be left in their original language.</li>
                    <li>If there is a Korean translated term, but the meaning is not clear, use the translated term and put the original term into brackets at first and then use translated term thereafter.</li>
                    <li>Units of measurement should be in SI (International System) units. Authors or editorial board can adjust to non-SI units if needed. Do not spell out standard units of measurement except at the beginning of sentences and use Arabic numerals and standard abbreviations.</li>
                </ol>
            </div>
            <!-- // e:Manuscript Preparation -->

            <!-- s:Manuscript Format -->
            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">Manuscript Format</h4>
                </div>
                <ol class="list-type list-type-decimal">
                    <li>
                        <strong>Title Page</strong>
                        <p>
                            The title should contain these elements:
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>Full title (not to exceed 100 characters, including spaces)</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>Running title (not to exceed 50 characters, including spaces)</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>Authors' names, academic degrees, and affiliations</div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>Address (road name based address system)</div>
                            </li>
                            <li>
                                <span>5)</span>
                                <div>Information for correspondence</div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <strong>Abstract and Keywords</strong>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>English is official language in abstract in original article, review article, and case report.</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>Do not cite references in the abstract.</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>Avoid acronyms and abbreviations. If needed, define at first use with acronym or abbreviation in parentheses.</div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>Do not exceed 250 words.</div>
                            </li>
                            <li>
                                <span>5)</span>
                                <div>Use the following headings for original articles:
                                    <ul class="list-type list-type-bar">
                                        <li>Background and Objectives—rationale for study</li>
                                        <li>Subjects (Materials) and Methods—brief presentation of study design and key methods</li>
                                        <li>Results—succinct presentation of key results; include sample sizes throughout</li>
                                        <li>Conclusion—succinct statement of data interpretation</li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <span>6)</span>
                                <div>Abstracts for review articles and case reports do not have a specific format.</div>
                            </li>
                            <li>
                                <span>7)</span>
                                <div>Keywords (5 words maximum) are recommended to be used from the Medical Subject Headings (MeSH) list of Index Medicus (<a href="http://www.nlm.nih.gov/mesh" target="_blank" class="link">http://www.nlm.nih.gov/mesh</a>). If suitable terms are not available, new keywords may be used.</div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <strong>Main Body Text</strong>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>
                                    Typical main headings include Introduction, Subjects (Materials) and Methods, Results, Discussion, Acknowledgments for original articles.
                                    For review articles, main heading includes Introduction and Conclusion; the body of the article is organized with subheadings. <br>
                                    Editorial articles are composed of Summary and Discussion headings. <br>
                                    Case reports are arranged with Introduction, Case, and Discussion headings.
                                </div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>
                                    Abbreviations must be defined at first mention in the text and at each table and figure.
                                </div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>
                                    The Introduction includes the background and the aims of the study.
                                </div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>
                                    The Subjects(Materials) and Methods should be described in detail and also include statistical methods. Please note that the Methods and Results should be able to stand alone and provide sufficient information for the reader to understand the basic methods of the study and to review the fundamental findings in a mechanistic way. Reports of studies on humans and animals must indicate that the procedures followed were in accordance with institutional guidelines.
                                </div>
                            </li>
                            <li>
                                <span>5)</span>
                                <div>
                                    The Results should be described in proper order with figures and tables. Since authors can access the whole study they have an obligation to take responsibility for the results. The Editors reserve the right to ask for additional information from the corresponding author regarding measures that were taken to minimize bias and verify the integrity of the primary data and any analyses performed.
                                </div>
                            </li>
                            <li>
                                <span>6)</span>
                                <div>
                                    The Discussion includes new interpretation related to the study and the conclusion of the study. It must meet the objectives mentioned in the introduction study.
                                </div>
                            </li>
                            <li>
                                <span>7)</span>
                                <div>
                                    Every reference, figure, and table should be cited in the text in numerical order according to the order of mention.
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <strong>Acknowledgments</strong>
                        <p>
                            All sources of financial support including grants and funding agencies must be clearly stated and avoid abbreviations. Since the qualifications of the author does not correspond to the performance of the study the names of the contributors who helped the study should be included. It is not mandatory if there are no points to refer to.
                        </p>
                    </li>
                    <li>
                        <strong>References</strong>
                        <p>
                            The description of the journal reference should follow the below description or follow the NLM Style Guide for Authors:
                        </p>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>Accuracy of reference data is the responsibility of the author.</div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>Verify all references against original sources.</div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>List all authors for each reference; do not use "et al."</div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>Example:
                                    <ul class="list-type list-type-dot">
                                        <li>Tilz R, Boveda S, Deharo JC, Dobreanu D, Haugaa KH, Dagres N. Replacement of implantable cardioverter defibrillators and cardiac resynchronization therapy devices: results of the European Heart Rhythm Association survey. Europace. 2016;18:945-949.</li>
                                    </ul>
                                </div>
                            </li>
                            <li>
                                <span>5)</span>
                                <div>
                                    Cite references in numerical order according to first mention in the text. In the text, ensure accuracy of spelling and details of publication (i.e., the text citation should match the reference order).
                                </div>
                            </li>
                            <li>
                                <span>6)</span>
                                <div>
                                    Personal communications, unpublished observations, and submitted manuscripts are not legitimate references. They must be cited in the text only (not in the reference list) as follows: author name, degree(s) held, unpublished data, year to get the information.
                                </div>
                            </li>
                            <li>
                                <span>7)</span>
                                <div>
                                    References must be from a full-length publication in a peer-reviewed journal.
                                </div>
                            </li>
                            <li>
                                <span>8)</span>
                                <div>
                                    Abstracts may be cited only if they are the sole source and must be identified in the reference as "Abstract."
                                </div>
                            </li>
                            <li>
                                <span>9)</span>
                                <div>
                                    "In press" citations must have been accepted for publication and the name of the journal or book publisher must be included.
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <strong>Tables</strong>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>
                                    Begin each table on a separate page, double-spaced. The table submitted to MS Excel are not accepted. Only use MS word.
                                </div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>
                                    The table number should be Arabic, followed by a period and brief title.
                                </div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>
                                    Use same size font as the text.
                                </div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>
                                    Supply a brief heading for each column.
                                </div>
                            </li>
                            <li>
                                <span>5)</span>
                                <div>
                                    If symbol is used, indicate footnotes of table in this order: *, †, ‡, §, ||, #, **. This is explained at the bottom of the table.
                                </div>
                            </li>
                            <li>
                                <span>6)</span>
                                <div>
                                    Abbreviations used in the table must be defined in a footnote to the table.
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <strong>Figures</strong>
                        <ul class="list-type list-type-text">
                            <li>
                                <span>1)</span>
                                <div>
                                    Figures are to be formatted to GIF, TIFF, EPS, and JPG files with high resolution file (preferably 300 dpi for color figures and 900 dpi for line art and graphs). All figures and diagrams should be clear enough to identify and discern differences individually.
                                </div>
                            </li>
                            <li>
                                <span>2)</span>
                                <div>
                                    Figures should be clearly labeled. If description is needed within the figure, use letters and arrows of the same size and style (font size 10 point or higher.) If explaining a character or abbreviation within the figure, use the footnote to explain.
                                </div>
                            </li>
                            <li>
                                <span>3)</span>
                                <div>
                                    Supply a scale bar with photomicrographs.
                                </div>
                            </li>
                            <li>
                                <span>4)</span>
                                <div>
                                    Heading information should appear in the figure legend.
                                </div>
                            </li>
                            <li>
                                <span>5)</span>
                                <div>
                                    Provide double-spaced copy for figure legends on a separate page.
                                </div>
                            </li>
                            <li>
                                <span>6)</span>
                                <div>
                                    Symbols and abbreviations must be defined in the figure or its legend.
                                </div>
                            </li>
                            <li>
                                <span>7)</span>
                                <div>
                                    Limit white space between the panel and panel label.
                                </div>
                            </li>
                            <li>
                                <span>8)</span>
                                <div>
                                    Put a period at the end of a figure legend
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <strong>Supplementary materials</strong>
                        <p>
                            Supplemental materials will be published in the online version only. They may consist of 1) Information that cannot be printed, such as animations, video clips, and sound recordings, 2) Information that can be presented more conveniently in electronic form and 3) Large original data, e.g. additional tables, illustrations, etc.
                        </p>
                    </li>
                </ol>
            </div>
            <!-- // e:Manuscript Format -->

            <!-- s:Copyright & General Online Submission Information -->
            <div class="sub-tab-con js-tab-con">
                <div class="sub-contit-wrap">
                    <h4 class="sub-contit">Copyright & General Online Submission Information</h4>
                </div>
                <p>
                    All published papers become the permanent property of the Korean Heart Rhythm Society and MMK Communications Limited and must not be published elsewhere without written permission. If needed, a copyright transfer form should be submitted to the editorial office. <br><br>

                    All manuscripts must be submitted electronically. Before proceeding to the online submission site, please prepare your manuscript according to the instructions listed in the General Preparation Instructions section. When your manuscript is ready for submission, please go to <a href="http://submit.e-arrhythmia.org/" target="_blank" class="link">http://submit.e-arrhythmia.org/</a>

                </p>
            </div>
            <!-- // e:Copyright & General Online Submission Information -->
        </div>
    </article>
@endsection

@section('addScript')
@endsection