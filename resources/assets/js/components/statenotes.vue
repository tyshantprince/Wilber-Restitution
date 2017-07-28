<template>
    <div>
    	<span class="state-notes-header">
		<h1>State<span class="weight-normal"> Notes</span></h1>
		<span class="state-site">
			<!--<a href="http://<?php echo $note_data['stateWebsite']['stateRestitutionWebsite']; ?>" target="_blank"><?php echo $note_data['stateWebsite']['stateRestitutionWebsite']; ?></a>-->
		</span>
	</span>

        <div id="notes-container">

            <div class="note-single" id="note-<?php echo $note_item['noteId']; ?>">
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci alias aperiam beatae blanditiis cumque expedita laborum laudantium nam natus perspiciatis porro quas, qui recusandae sed, sequi similique vel veniam voluptatibus.</p>
                <div class="edit-bar">
                    <!-- each set of user-buttons is assigned the TYPE, ID, and ACTION per button as data values -->
                    <ul class="user-buttons" data-type="note" data-id="">
                        <li><a href="#" data-action="update"><span class="btn-edit">edit</span></a></li>
                        <li><a href="#" data-action="delete"><span class="btn-delete">delete</span></a></li>
                    </ul>
                </div><!-- end edit bar -->
            </div>

            <div class="add-field right">
                <a href="#" class="btn-large" data-type="note" data-state="<?php echo $state; ?>"><span class="btn-add">New Note</span></a>
            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: ['notes'],
        mounted() {
            console.log(this.props.notes)
        }
    }
</script>
