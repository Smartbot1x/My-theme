<?php
/**
 * Skills & Tools Component
 
 */

// Skills  array
$skills = [
    ['name' => 'HTML5', 'img' => 'https://i.postimg.cc/90cYBMc2/html5.png'],
    ['name' => 'CSS3', 'img' => 'https://i.postimg.cc/cCDwMBD7/css3.png'],
    ['name' => 'Javascript', 'img' => 'https://i.postimg.cc/htmQfnq1/javascript.png'],
    ['name' => 'SASS', 'img' => 'https://i.postimg.cc/jSrKsYqf/sass.png'],
    ['name' => 'react', 'img' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/a/a7/React-icon.svg/1150px-React-icon.svg.png'],
];

// Tools array
$tools = [
    ['name' => 'Webpack', 'img' => 'https://i.postimg.cc/NFTk6zy3/webpack.png'],
    ['name' => 'Git', 'img' => 'https://i.postimg.cc/Gp5FZCv0/git.png'],
    ['name' => 'Npm', 'img' => 'https://i.postimg.cc/wjxDMvV8/npm.png'],
    ['name' => 'VS Code', 'img' => 'https://i.postimg.cc/zvXqW9PB/vs-code.png'],
    ['name' => 'Wp', 'img' => 'https://www.citypng.com/public/uploads/preview/wordpress-logo-image-png-701751694773680sodsik7zlf.png'],
];

/**
 * Function  for skills or tools
 */
function generate_skill_items($items) {
    $output = '';
    foreach ($items as $item) {
        $output .= '<li>';
        $output .= '<div class="skills-card">';
        $output .= '<div class="tooltip">' . esc_html($item['name']) . '</div>';
        $output .= '<div class="card-icon">';
        $output .= '<img src="' . esc_url($item['img']) . '" alt="' . esc_attr($item['name']) . ' logo" />';
        $output .= '</div>';
        $output .= '</div>';
        $output .= '</li>';
    }
    return $output;
}
?>

<div class="skills-box" data-skills-box>
    <h1>Skills &amp; Tools</h1>
    
    <div class="skills-toggle" data-toggle-box>
        <button 
            class="toggle-btn active" 
            data-tab="skills"
            aria-expanded="true"
            aria-controls="skills-list"
        >
            Skills
        </button>
        <button 
            class="toggle-btn" 
            data-tab="tools"
            aria-expanded="false"
            aria-controls="tools-list"
        >
            Tools
        </button>
    </div>
    
    <ul 
        class="skills-list active" 
        id="skills-list" 
        role="list" 
        aria-label="Skills"
        data-content="skills"
    >
        <?php echo generate_skill_items($skills); ?>
    </ul>
    
    <ul 
        class="tools-list" 
        id="tools-list" 
        role="list" 
        aria-label="Tools"
        data-content="tools"
        style="display: none;"
    >
        <?php echo generate_skill_items($tools); ?>
    </ul>
</div>