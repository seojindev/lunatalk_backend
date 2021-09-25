<?php

return [

    'admin' => [
        'main-slide' => [
            'name' => [
                'required' => '메인 슬라이드 그룹명을 입력해주세요.',
                'unique' => '이미 사용중인 그룹명입니다.'
            ],
            'active' => [
                    'required' => '슬라이드 상태를 선택해 주세요.',
                    'in' => '정확한 슬라이드 상태를 선택해 주세요.',
                ],
            'main_slide' => '정확한 형태로 보내주세요.',
            ],
    ]
];