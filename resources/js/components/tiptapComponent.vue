<template>
  <div class="editor">
    <editor-menu-bar :editor="editor" v-slot="{ commands, isActive }">
      <div class="menubar">

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.bold() }"
          @click="commands.bold"
        >
        Bold
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.italic() }"
          @click="commands.italic"
        >
        Italic
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.strike() }"
          @click="commands.strike"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.underline() }"
          @click="commands.underline"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.code() }"
          @click="commands.code"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.paragraph() }"
          @click="commands.paragraph"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.heading({ level: 1 }) }"
          @click="commands.heading({ level: 1 })"
        >
          H1
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.heading({ level: 2 }) }"
          @click="commands.heading({ level: 2 })"
        >
          H2
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.heading({ level: 3 }) }"
          @click="commands.heading({ level: 3 })"
        >
          H3
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.bullet_list() }"
          @click="commands.bullet_list"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.ordered_list() }"
          @click="commands.ordered_list"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.blockquote() }"
          @click="commands.blockquote"
        >
        </button>

        <button
          class="menubar__button"
          :class="{ 'is-active': isActive.code_block() }"
          @click="commands.code_block"
        >
        </button>

        <button
          class="menubar__button"
          @click="commands.horizontal_rule"
        >
        </button>

        <button
          class="menubar__button"
          @click="commands.undo"
        >
        </button>

        <button
          class="menubar__button"
          @click="commands.redo"
        >
        </button>

      </div>
    </editor-menu-bar>

    <editor-content class="editor__content" :editor="editor" />
  </div>
</template>

<script>
import { Editor, EditorContent, EditorMenuBar } from 'tiptap'
import {
  Blockquote,
  CodeBlock,
  HardBreak,
  Heading,
  HorizontalRule,
  OrderedList,
  BulletList,
  ListItem,
  TodoItem,
  TodoList,
  Bold,
  Code,
  Italic,
  Link,
  Strike,
  Underline,
  History,
} from 'tiptap-extensions'

export default {
  components: {
    EditorContent,
    EditorMenuBar,
  },
  data() {
    return {
      editor: new Editor({
        extensions: [
          new Blockquote(),
          new BulletList(),
          new CodeBlock(),
          new HardBreak(),
          new Heading({ levels: [1, 2, 3] }),
          new HorizontalRule(),
          new ListItem(),
          new OrderedList(),
          new TodoItem(),
          new TodoList(),
          new Link(),
          new Bold(),
          new Code(),
          new Italic(),
          new Strike(),
          new Underline(),
          new History(),
        ],
        content: `


<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque sit amet diam non odio suscipit blandit sed eu ex. Nunc tempor rutrum laoreet. Phasellus fringilla facilisis sodales. Nam vitae turpis sodales, gravida mauris ac, imperdiet enim. Nam congue felis nulla, sed placerat libero varius vel. Nullam pretium gravida est id auctor. Vestibulum a gravida dui. Fusce porttitor orci et est sollicitudin, id euismod ligula fermentum. Fusce diam massa, molestie ut libero et, tempus imperdiet tortor. Donec ullamcorper vehicula augue id finibus. Vivamus convallis tellus purus, vitae vehicula dui volutpat id. Donec id feugiat ipsum. Vivamus et ornare lacus, at faucibus mauris.</p>

<p>Pellentesque lectus sem, efficitur eget sagittis sed, placerat nec felis. Sed nec vulputate velit, vel tincidunt massa. Nam mollis cursus metus, at dictum neque finibus a. Duis cursus ultrices libero, venenatis malesuada magna pharetra vitae. Vestibulum velit velit, tristique vitae venenatis vel, mollis eget sapien. Nullam vel urna vel nisl faucibus egestas. Praesent tempus maximus felis, id sagittis sem pellentesque non. Quisque vulputate sem vel est tincidunt fermentum. Pellentesque porta in turpis vel rhoncus. Aenean ac nisl quis sem interdum aliquam semper nec mi. Nullam viverra quam eget lobortis dapibus.</p>

<p>Fusce convallis nisl ornare elit tincidunt, quis elementum turpis mattis. Sed ut purus ligula. Duis commodo, diam varius accumsan sodales, elit dui consectetur augue, et elementum purus ante eget tortor. In nec nisi commodo, maximus urna eu, egestas eros. Etiam nec nisi vitae dui volutpat facilisis ac non odio. Etiam congue congue libero ac molestie. Nunc porta imperdiet felis rutrum ornare. Vivamus efficitur ac ex quis volutpat. Nulla nec arcu justo.</p>

<p>Nam ac lacus id velit dictum sollicitudin at tempus dolor. Mauris laoreet rutrum elementum. Aenean laoreet eros sit amet orci dignissim pharetra. Ut suscipit sodales erat, nec ornare libero ullamcorper sit amet. Maecenas sollicitudin nisl tortor, eget tristique purus aliquet vel. Donec porttitor, lorem et vehicula suscipit, justo dui placerat sapien, at auctor dolor tellus vel sem. Vivamus at felis id purus faucibus interdum. Fusce ac ipsum at erat iaculis tempus. Aliquam erat volutpat. Maecenas et elementum risus. Maecenas laoreet aliquet sem. Ut eu finibus nisl. Nunc id erat sed ex tincidunt egestas nec at odio. Donec in consequat nibh.</p>

<p>Morbi vulputate nunc ut imperdiet convallis. Fusce aliquet facilisis tellus ac dictum. Mauris bibendum malesuada urna. Sed egestas est urna, in condimentum justo commodo ac. Vestibulum auctor et justo vel consequat. Ut vel nisi et purus hendrerit maximus luctus vitae dolor. In ac nibh id ligula accumsan dictum. 
        `,
      }),
    }
  },
  beforeDestroy() {
    this.editor.destroy()
  },
}
</script>
